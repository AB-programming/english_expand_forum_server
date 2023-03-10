<?php

namespace app\controller;

use app\Request;

class TopicController
{
    public function getAllTopic() {
        $topicService = invoke("app\service\TopicService");
        return $topicService->getAllTopic();
    }

    public function putTopic(Request $request) {
        $topicService = invoke("app\service\TopicService");
        $file = request()->file("file");
        $imageCount = 0;

        if (!empty($file)) {
            $file->move("../public/images/topic", $request->param('id')
                . '-'
                . $imageCount
                . '.jpg');
        }

        return $topicService->putTopic($request->param('id'), $request->param('publishId'),
            $request->param('content'), $request->param('timer'), empty($file) ? $imageCount : ++$imageCount
        );
    }

    public function getTopicListByPublisherId(Request $request) {
        $topicService = invoke("app\service\TopicService");
        return $topicService->getTopicListByPublisherId($request->param("id"));
    }

    public function deleteTopicById(Request $request) {
        $topicService = invoke("app\service\TopicService");
        return $topicService->deleteTopicById($request->param("id"));
    }
}