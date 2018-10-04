<?php

main::start("Mydata.csv");

class main{

    static public function start($filename){

        $records =csv::getRecords($filename);
        $table = html::generateTable($records);


    }
}

class html{

    public static function generateTable($records)
    {

        foreach ($records as $record) {
            $array = $record->returnArray();
            print_r($array);
        }

    }
}
class csv{
    public static function getRecords($filename){

        $file = fopen($filename,"r");
        $fieldNames = array();
        $count = 0;

        while(! feof($file))
        {
            $record=fgetcsv($file);
            if($count==0) {

                $fieldNames = $record;

            }
            else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }

        fclose($file);
        return $records;

    }
}

class record
{

    public function __construct(Array $fieldNames = null , $values = null)
    {

        $record = array_combine($fieldNames, $values);


        foreach ($record as $property => $value) {
          $this->createProperty($property, $value);

          }
    }
    public function ReturnArray(){

        $array= (array) $this;

        return $array;
    }

    public function createProperty($name = 'First', $value = 'Pritam'){
                $this->{$name} = $value;
    }

}
class recordFactory
{

    public static function create(Array $fieldnames = null, Array $values  = null)
    {

        $record=new record($fieldnames , $values);

        return $record;

    }

}

