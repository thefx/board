<?php

//! Base controller
class Controller {

    protected $db;

    //! Instantiate class
    function __construct()
    {
        $f3=\Base::instance();

        // Connect to the database
        $db=new \DB\SQL(
            $f3->get('db_name'),
            $f3->get('db_user'),
            $f3->get('db_password')
        );

        // Save frequently used variables
        $this->db=$db;
    }

    //! HTTP route pre-processor
    function beforeroute($f3)
    {
        $f3->set('title', '');
    }

    //! HTTP route post-processor
    function afterroute($f3)
    {
        // Render HTML layout
        echo \Template::instance()->render('tpl_main.htm');
    }
}
