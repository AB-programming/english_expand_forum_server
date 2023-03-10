<?php

namespace app\service;

use app\model\Comment;
use app\model\Topic;
use app\model\User;
use think\Service;

class TopicService extends Service
{
    public function __construct()
    {
    }

    public function getAllTopic()
    {

        return json(array("status" => 1, "info" => "查找成功", "topics" => Topic::order('timer', 'desc')->select()));
    }

    public function putTopic(string $id, string $publishId, string $content, string $timer, $count)
    {
        if (empty($id) || empty($publishId) || empty($content)) {
            return json(array("status" => 0, "info" => "未编辑任何内容"));
        }

        $publishName = User::find($publishId)->name;

        $imageCount = '';

        for ($i = 0; $i < $count; $i++) {
            $imageCount = $imageCount . $id . '-' . $i . ';';
        }
        $imageCount = substr_replace($imageCount, "", -1);

        $topic = new Topic();
        $topic->save(['id' => $id, 'publisherId' => $publishId, 'publisherName' => $publishName,
            'content' => $content, 'imageCount' => $imageCount, 'timer' => $timer]);
        return json(array("status" => 1, "info" => "上传成功"));
    }

    public function getTopicListByPublisherId(string $publisherId)
    {
        if (empty($publisherId)) {
            return json(array("status" => 0, "info" => "publisherId为空"));
        }
        $topics = Topic::where("publisherId", $publisherId)->order("timer", "desc")->select();
        return json(array("status" => 1, "info" => "查询成功", "topics" => $topics));
    }

    public function deleteTopicById(string $id)
    {
        if (empty($id)) {
            return json(array("status" => 0, "info" => "id为空"));
        }

        //删除话题的缓存图片
        $imageCount = Topic::find($id)->imageCount;
        $images = explode(";", $imageCount);
        foreach ($images as $image) {
            unlink("../public/images/topic/" . $image . ".jpg");
        }

        //此处偷懒未加事务处理
        Topic::destroy($id);
        Comment::where("topic_id", $id)->delete();
        return json(array("status" => 1, "info" => "删除成功"));
    }
}