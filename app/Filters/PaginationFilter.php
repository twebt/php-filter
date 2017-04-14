<?php
namespace App\Filters;

class PaginationFilter {

    /**
     * url
     *@var private
     */
    private $url = '?';

    /**
     * html
     *@var private
     */
    public $html = '';

    /**
     * links
     *@var private
     *@return array
     */
    private $links = array();

    /**
     * Generate filter links
     *@return html
     */
    public function pagination($data, $params) {

        unset($params['page']);

        if (count(array_flip($params)) > 1) {
            foreach ($params as $param => $value) {
                $this->url = $this->url . $param . '=' . $value . '&';
            }
        }

        if ($data['total'] > 0 && $data['total'] != 1 && $data['page'] <= $data['total']) {

            $links = array(
                'first'       => true,
                'right_links' => $data['page'] + 5,
                'next_links'  => 4,
                'previous'    => $data['page'] - 1,
                'next'        => $data['page'] + 1
            );

            $this->html  = '<ul class="pagination">';

            if ($data['page'] > 1) {
                $links['first'] = false;
                $previous_link = ($links['previous'] == 0) ? 1 : $links['previous'];
                $this->html .= '<li><a href="' . $this->url . 'page=1 data-page="1" title="First">&laquo;</a></li>';
                $this->html .= '<li class="previous"><a href=' . $this->url . 'page=' . $previous_link . ' data-page="' . $previous_link . '" title="Previous">&lt;</a></li>';
                
                // Left links
                for ($i = ($data['page'] - 2); $i < $data['page']; $i++) {
                    if ($i > 0){
                        $this->html .= '<li><a href=' . $this->url . 'page=' . $i . ' data-page="' . $i . '" title="Page' . $i . '">' . $i . '</a></li>';
                    }
                }  
            }

            // set active 
            if ($links['first']) {
                $this->html .= '<li class="first active"><a class="active">' . $data['page'] . '</a></li>'; 
            } elseif ($data['page'] == $data['total']) {
                $this->html .= '<li class="last active"><a class="active">' . $data['page'] . '</a></li>'; 
            } else {
                $this->html .= '<li class="active"><a class="active">' . $data['page'] . '</a></li>'; 
            }

            // Right Links
            for ($i = $data['page'] + 1; $i < $links['right_links'] ; $i++) {
                if ($i <= $data['total']) {
                    $this->html .= '<li><a href=' . $this->url . 'page=' . $i . ' data-page="'. $i .'" title="Page '. $i .'">'. $i .'</a></li>';
                }
            }

            if ($data['page'] < $data['total']) { 

                // next link
                $next_link = ($i > $data['total']) ? $data['total'] : $i - $links['next_links'];
                $this->html .= '<li class="next"><a href=' . $this->url . 'page=' .  $next_link . ' data-page="' . $next_link . '" title="Next">&gt;</a></li>';

                // last link
                $this->html .= '<li class="last"><a href=' . $this->url . 'page=' . $data['total'] . ' data-page="' . $data['total'] . '" title="Last">&raquo;</a></li>';
            }

            $this->html .= '</ul>';
        }

        return $this->html;
    }
}
