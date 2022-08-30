<?php
namespace Interfaces;

interface DatabaseInterface
{
    public function save($statement, $datas);
    public function update($statement, $datas);
    public function delete($statement, $datas);
    public function query($statement, $one = false);
}
