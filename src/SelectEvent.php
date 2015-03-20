<?php
namespace Evflow\Benchmarks;

use Athletic\AthleticEvent;

class SelectEvent extends AthleticEvent
{
    const STREAM_COUNT = 100;
    private $readStreams;
    private $writeStreams;

    public function classSetUp()
    {
        // open up a ton of streams
        for ($i = 0; $i < self::STREAM_COUNT; $i++) {
            touch('/tmp/SelectEventRead'.$i);
            $this->readStreams[] = fopen('/tmp/SelectEventRead'.$i, 'rb');
        }
        for ($i = 0; $i < self::STREAM_COUNT; $i++) {
            $this->writeStreams[] = fopen('/tmp/SelectEventWrite'.$i, 'wb');
        }
    }

    public function classTearDown()
    {
        // close all the streams we opened
        for ($i = 0; $i < self::STREAM_COUNT; $i++) {
            fclose($this->readStreams[$i]);
            unlink('/tmp/SelectEventRead'.$i);
            fclose($this->writeStreams[$i]);
            unlink('/tmp/SelectEventWrite'.$i);
        }
    }

    /**
     * @iterations 10000
     */
    public function singleReadSelect()
    {
        $read = array_values($this->readStreams);
        $write = [];
        $except = [];
        stream_select($read, $write, $except, 0);
    }

    /**
     * @iterations 10000
     */
    public function multipleReadSelects()
    {
        for ($i = 0; $i < self::STREAM_COUNT; $i++) {
            $read = [$this->readStreams[$i]];
            $write = [];
            $except = [];
            stream_select($read, $write, $except, 0);
        }
    }

    /**
     * @iterations 10000
     */
    public function singleWriteSelect()
    {
        $read = [];
        $write = array_values($this->writeStreams);
        $except = [];
        stream_select($read, $write, $except, 0);
    }

    /**
     * @iterations 10000
     */
    public function multipleWriteSelects()
    {
        for ($i = 0; $i < self::STREAM_COUNT; $i++) {
            $read = [];
            $write = [$this->writeStreams[$i]];
            $except = [];
            stream_select($read, $write, $except, 0);
        }
    }
}
