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

    /**
     * @param $f3
     */
    function editRecord($f3)
    {
        $record=new \DB\SQL\Mapper($this->db, 'records');
        $record->load(array('record_id=?', array($f3->get('GET.id'))));

        if ($record->dry())
            $f3->reroute('/admin');

        $record->copyto('post');

        $f3->set('title', 'Редактировать запись');
        $f3->set('inc','v_edit_record.htm');
    }

    /**
     * @param $f3
     */
    function saveRecord($f3)
    {
        $record = new \DB\SQL\Mapper($this->db, 'records');
        $record->load(array('record_id=?', array($f3->get('GET.id'))));

        if ($record->dry())
            $f3->reroute('/admin');

        $record->copyfrom($f3->get('POST'));
        $record->save();
        $f3->reroute('/admin');
    }

    /**
     * @param $f3
     */
    function delRecord($f3)
    {

        if ($f3->get('POST'))
        {
            $record = new \DB\SQL\Mapper($this->db, $this->table);

            $record->load(array('record_id=?', array($f3->get('GET.id'))));

            if (!$record->dry())
            {
                $record->erase();
            }
        }

        $f3->reroute();
    }




}
