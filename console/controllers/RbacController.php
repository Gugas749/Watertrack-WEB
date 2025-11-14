<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // === PERMISSIONS ===
        $perms = [
            'createMeter' => 'Cria Contador',
            'updateMeter' => 'Edita Contador',
            'deleteMeter' => 'Apaga Contador',
            'createUser' => 'Cria Utilizador',
            'updateUser' => 'Edita Utilizador',
            'deleteUser' => 'Apaga Utilizador',
            'createEnterprise' => 'Cria Empresa',
            'updateEnterprise' => 'Edita Empresa',
            'deleteEnterprise' => 'Apaga Empresa',
            'createLogMeter' => 'Cria Log Contador',
            'updateLogMeter' => 'Edita Log Contador',
            'deleteLogMeter' => 'Apaga Log Contador',
            'createProblemMeter' => 'Cria Avaria Contador',
            'updateProblemMeter' => 'Edita Avaria Contador',
            'deleteProblemMeter' => 'Apaga Avaria Contador',
        ];

        $permObjects = [];
        foreach ($perms as $name => $desc) {
            $perm = $auth->createPermission($name);
            $perm->description = $desc;
            $auth->add($perm);
            $permObjects[$name] = $perm;
        }

        // === ROLES ===
        $admin = $auth->createRole('admin');
        $technician = $auth->createRole('technician');
        $resident = $auth->createRole('resident');
        $auth->add($admin);
        $auth->add($technician);
        $auth->add($resident);

        // === ASSIGN PERMISSIONS TO ROLES ===
        // ADMIN: has all permissions
        foreach ($permObjects as $perm) {
            $auth->addChild($admin, $perm);
        }

        // technician:
        $auth->addChild($technician, $permObjects['createMeter']);
        $auth->addChild($technician, $permObjects['updateMeter']);
        $auth->addChild($technician, $permObjects['createLogMeter']);
        $auth->addChild($technician, $permObjects['updateLogMeter']);
        $auth->addChild($technician, $permObjects['deleteLogMeter']);
        $auth->addChild($technician, $permObjects['updateProblemMeter']);
        $auth->addChild($technician, $permObjects['deleteProblemMeter']);

        // resident:
        $auth->addChild($resident, $permObjects['updateMeter']);
        $auth->addChild($resident, $permObjects['createProblemMeter']);
        $auth->addChild($resident, $permObjects['updateProblemMeter']);
        $auth->addChild($resident, $permObjects['deleteProblemMeter']);

        // OPTIONAL: admin inherits all other roles
        $auth->addChild($admin, $technician);
        $auth->addChild($admin, $resident);
        $auth->addChild($admin, $permObjects['deleteMeter']);
        $auth->addChild($admin, $permObjects['createUser']);
        $auth->addChild($admin, $permObjects['updateUser']);
        $auth->addChild($admin, $permObjects['deleteUser']);
        $auth->addChild($admin, $permObjects['createEnterprise']);
        $auth->addChild($admin, $permObjects['updateEnterprise']);
        $auth->addChild($admin, $permObjects['deleteEnterprise']);

        // Example assignment (user IDs)
        // $auth->assign($admin, 1);
        // $auth->assign($technician, 2);
        // $auth->assign($resident, 3);
    }
}