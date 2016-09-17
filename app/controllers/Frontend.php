<?php

/**
 * Class Frontend
 */
class Frontend extends Controller {

    /**
     * Home page
     *
     * @param $f3
     */
    function home($f3)
    {
        $records = $this->db->exec('SELECT record_id,name,text FROM records ORDER BY record_id DESC;');

        $f3->set('records', $records);
        $f3->set('title', 'Главная');
        $f3->set('inc','v_home.htm');
    }

    function addRecord($f3)
    {
        $post = $f3->get('POST');

        // TODO: Check POST

        if ($post['name'] == '')
            $f3->reroute();

        $this->db->exec('INSERT INTO records (name,text) VALUES(?,?);',
            array($post['name'],$post['text']));

        $f3->reroute();
    }
}
