<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace console\controllers;

use yii;
use yii\console\controller;

class RbacController extends Controller{
    public function actionInit(){
        $auth = yii::$app->authManager;
        
        /**
         * permissions
         */
        
        //create and add "createPost" permissions
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'User can create a post';
        $auth->add($createPost);
        
         //create and add "updatePost" permissions
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'User can update post';
        $auth->add($updatePost);
        
        /**
         * Roles
         */
        
        //create and add "user" role
        $user = $auth->createRole('user');
        $auth->add($user);
        
        //create and add "author" role
        $author = $auth->createRole('author');
        $auth->add($author);
        
        //create and add "admin" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        
        /**
         * Mutual connections
         */
        
        //"author" can create new post
        $auth->addChild($author, $createPost);
        
        //"admin" can do everyting what "author" can
        $auth->addChild($admin, $author);
        //...and...
        //"admin" can update ALL Posts
        $auth->addChild($admin, $updatePost);
        
        echo 'succes';
    }
//    public function actionCreateAuthorRule(){
//        $auth = yii::$app->authManager;
//        
//        //add the rule
//        $rule = new \console\rbac\AuthorRule();
//        $auth->add($rule);
//        
//        //add the "updateOwnPost" permission and associate the rule with it.
//        $updateOwnPost = $auth->createPermission('updateOwnPost');
//    }
}
