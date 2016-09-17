<?php

/**
 * Class Backend
 */
class Backend extends Controller {

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
        $f3->set('inc','v_admin.htm');
    }

    function delRecord($f3)
    {
        if ($f3->get('POST'))
        {
            $this->db->exec('DELETE FROM records WHERE record_id = ?;', array($f3->get('POST.delRecord')));
        }

        $f3->reroute();
    }
}
