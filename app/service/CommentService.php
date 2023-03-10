<?php

namespace app\service;

use app\model\Comment;
use app\model\Topic;
use app\model\User;
use think\Service;

class CommentService extends Service
{
    public function getAllComment() {
        return json(array("status" => 1, "info" => "查找成功",
            "comments" => Comment::order("comment_timer", 'desc')->select()));
    }

    public function putComment(string $id, string $topicId, string $commenterId,
                               string $commentText, string $commentTimer) {
        if (empty($commenterId)) {
            return json(array("status" => 0, "info" => "用户未登录"));
        }
        if (empty($commentText)) {
            return json(array("status" => 0, "info" => "未评论任何内容"));
        }
        $commenterName = User::find($commenterId)->name;
        $comment = new Comment();
        $comment->save(['id' => $id, 'topic_id' => $topicId, 'commenter_id' => $commenterId,
            'commenter_name' => $commenterName, 'comment_text' => $commentText, 'comment_timer' => $commentTimer]);
        return json(array("status" => 1, "info" => "评论成功"));
    }

    public function getCommentByCommenterId(string $commenterId) {
        if (empty($commenterId)) {
            return json(array("status" => 0, "info" => "topicId为空"));
        }

        $comments = Comment::where("commenter_id", $commenterId)->order("comment_timer", "desc")->select();
        return json(array("status" => 1, "info" => "查询成功", "comments" => $comments));
    }

    public function deleteCommentById(string $commentId) {
        if (empty($commentId)) {
            return json(array("status" => 0, "info" => "id为空"));
        }

        Comment::destroy($commentId);
        return json(array("status" => 1, "info" => "删除成功"));
    }

    public function getCommentByPublisherId(string $publisherId) {
        if (empty($publisherId)) {
            return json(array("status" => 0, "info" => "publisherId为空"));
        }
        $myTopics = array();
        $topics = Topic::where("publisherId", $publisherId)->select();
        if (count($topics) !== 0) {
            $totalComments = array();
            foreach ($topics as $topic) {
                $comments = Comment::where("topic_id", $topic->id)->select();
                array_push($myTopics, array("topic" => $topic, "comments" => $comments));
            }
            return json(array("status" => 1, "info" => "查询成功", "message" => $myTopics));
        }
        return json(array("status" => 0, "info" => "该用户没有发布话题"));
    }
}