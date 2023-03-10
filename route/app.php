<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');

//topic
Route::get('topic/getAllTopic', 'topicController/getAllTopic');
Route::post('topic/publish', 'topicController/putTopic');
Route::get('topic/getTopicListByPublisherId', 'topicController/getTopicListByPublisherId');
Route::post('topic/deleteTopicById', 'topicController/deleteTopicById');

//user
Route::post('user/getUserById', 'userController/getUserById');
Route::get('user/testDel', 'userController/testDel');

//comment
Route::post('comment/putComment', 'commentController/putComment');
Route::get('comment/getAllComment', 'commentController/getAllComment');
Route::get('comment/getCommentByCommenterId', 'commentController/getCommentByCommenterId');
Route::post('comment/deleteCommentById', 'commentController/deleteCommentById');
Route::get('comment/getCommentByPublisherId', 'commentController/getCommentByPublisherId');
