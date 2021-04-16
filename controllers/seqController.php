<?php

class seqController
{

    private $redis;
    private $channelId;

    public function __construct()
    {
        header('Access-Control-Allow-Origin:*');
        header("Access-Control-Allow-Headers:*");

        $redis = new Redis();
        $redis->connect('192.168.1.9', 6379);
        $this->redis = $redis;
        $this->channelId = getapk("channelId");
        if (empty($this->channelId)) {
            json(["error" => "channelId No None!"]);
        }
    }

    // 设置当前房间的基本数据
    public function setRoomData()
    {
        $channeData = file_get_contents("php://input");
        if (is_not_json($channeData)) {
            json(["error" => "channel Data No None!"]);
        }
        $channeData = json_decode($channeData);
        if (empty($channeData->cmd)) {
            json(["error" => "Json Incorrect data format!"]);
        }
        $key = $this->channelId;
        $result = $this->redis->set($key, json_encode($channeData), 3600 * 24 * 30);
        json(["code" => 0, "key" => $key, "result" => json_encode($channeData)]);
    }

    // 获取当前房间的基本数据
    public function getRoomData()
    {
        $data = $this->redis->get($this->channelId);
        json(['result' => json_decode($data)]);
    }
}
