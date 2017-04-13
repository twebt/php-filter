<?php
namespace App\Filters;
use App\Database\Database;

class OptionFilter {

    /**
     * db
     * @var private
     */
    private $db;


    /**
     * filter_server
     * @var public
     */
    private $filter_server = '';

    /**
     * filter_domain
     * @var public
     */
    private $filter_domain = '';

    /**
     * filter_version
     * @var public
     */
    private $filter_version = '';

    /**
     * filter_cf
     * @var public
     */
    private $filter_cf = '';

    /**
     * filter_fw
     * @var public
     */
    private $filter_fw = '';

    /**
     * filter_id
     * @var public
     */
    private $filter_id = '';


    /**
     * array parameters
     * @var public
     */
    public $url_parameters = array(
        'server'      => '',
        'domain'      => '',
        'version'     => '',
        'custom_form' => '',
        'action'      => '',
        'id'          => '',
        'page'        => 1
    );


    /**
     * limit
     * @var public
     */
    private $limit = 50;

    /**
     * Create new instance of database class
     */
    public function __construct(Database $database) {
        $this->db = $database;
        $this->db = $this->db->mysqli;
        $this->get_parameters();
    }


    /**
     * Get first 50 results from database
     * @return array
     */
    public function get_all() {

        $sql  = "SELECT id, server, domain, GROUP_CONCAT(path SEPARATOR '\n' ) paths, version, GROUP_CONCAT(action SEPARATOR '\n' ) actions, GROUP_CONCAT(good_url SEPARATOR '\n' ) good_urls, GROUP_CONCAT(mail_options SEPARATOR '\n' ) mail_optionss, custom_form FROM `forms` WHERE 1";
        $sql .= $this->filter_result();
        $sql .= " GROUP by domain ORDER BY id ASC LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql) or $mysqli->error;
        $stmt->bind_param('ii', $this->limit, $this->pagination_info()['offset']);
        $stmt->execute();
        $stmt->bind_result($id, $server, $domain, $paths, $version, $actions, $good_urls, $mail_optionss, $custom_form);

        $rows = array();

        while ($stmt->fetch()) :
            $rows[] = [
              'id'              =>  $id,
              'server'          =>  $server,
              'domain'          =>  $domain,
              'paths'           =>  $paths,
              'version'         =>  $version,
              'actions'         =>  $actions,
              'good_urls'       =>  $good_urls,
              'mail_optionss'   =>  $mail_optionss,
              'custom_form'     =>  $custom_form
            ];
        endwhile;


        // Return rows
        return $rows;
    }



    /**
     * These 3 columns will be filled into <select>
     * @return array
     */
    public function dropdown() {

        $sql = "SELECT server, version, custom_form FROM `forms`";
        $stmt = $this->db->prepare($sql) or die ('Problem preparing query');
        $stmt->execute();
        $stmt->bind_result($server, $version, $custom_form);

        $select_options = array();

        while ($stmt->fetch()) :
            $select_options[] = [
                'server'        => $server,
                'version'       => $version,
                'custom_form'   => $custom_form
            ];
        endwhile;

        sort($select_options);

        return $select_options;
    }


    /**
     * Get parameters and build SQL Query
     * @return string
     */
    private function filter_result() {
        $url_params = $this->get_parameters();
        unset($url_params['action']);
        unset($url_params['page']);

        $sql = '';

        foreach ($url_params as $mysql_field => $value) {
            if (!empty($value)) {
                $sql .= " AND $mysql_field = '" . $value . "'";
            }
            if (!empty($this->get_parameters()['action']) && $this->get_parameters()['action'] == 'yes') {
               $sql .= " AND action LIKE '%_essentials%'";
            }
        }

        return $sql;
    }


    /**
     * Get unique domains and total records in database
     * @return array
     */
    public function get_count() {

        $sql  = "SELECT COUNT(DISTINCT domain) FROM `forms` WHERE 1" . $this->filter_result();
        $domains = $this->db->query($sql);

        $records = $this->db->query("SELECT COUNT(domain) FROM `forms`");
        
        return array(
            'domains' => $domains->fetch_row(),
            'records' => $records->fetch_row()
        );
    }


    /**
     * Get url parameters and store them to array
     * @return array
     */
    public function get_parameters() {
        foreach ($this->url_parameters as $parameter => $value) {
            if (isset($_GET[$parameter]) && !empty($_GET[$parameter])) {
                $this->url_parameters[$parameter] = trim($_GET[$parameter]);
            }
        }
        return $this->url_parameters;
    }


    /**
     * Get limit and offset
     * @return array
     */
    public function pagination_info() { 
        return array(
            'url'    => $_SERVER['REQUEST_URI'],
            'page'   => $this->get_parameters()['page'],
            'total'  => ceil($this->get_count()['domains']['0'] / $this->limit),
            'limit'  => $this->limit,
            'offset' => ($this->get_parameters()['page'] - 1) * $this->limit
        );
    }
}
