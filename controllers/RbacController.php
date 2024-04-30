<?php
use yii\rbac\DbManager;

$authManager = Yii::$app->authManager;

// Create a new role
$adminRole = $authManager->createRole('admin');
$authManager->add($adminRole);

// Create a new permission
$manageUsersPermission = $authManager->createPermission('manageUsers');
$authManager->add($manageUsersPermission);
