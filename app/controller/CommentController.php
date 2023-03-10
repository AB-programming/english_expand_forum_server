<?php

namespace app\controller;

use app\Request;

class CommentController
{
    public function getAllComment(Request $request) {
        $commentService = invoke("app\service\CommentService");
        return $commentService->getAllComment();
    }

    public function putComment(Request $request) {
        $commentService = invoke("app\service\CommentService");
        return $commentService->putComment($request->param('id'), $request->param('topicId'),
            $request->param('commenterId'), $request->param('commentText'), $request->param('commentTimer'));
    }

    public function getCommentByCommenterId(Request $request) {
        $commentService = invoke("app\service\CommentService");
        return $commentService->getCommentByCommenterId($request->param("id"));
    }

    public function deleteCommentById(Request $request) {
        $commentService = invoke("app\service\CommentService");
        return $commentService->deleteCommentById($request->param("id"));
    }

    public function getCommentByPublisherId(Request $request) {
        $commentService = invoke("app\service\CommentService");
        return $commentService->getCommentByPublisherId($request->param("id"));
    }
}