<?php
/**
 * This file is part of cBackup, network equipment configuration backup tool
 * Copyright (C) 2017, Oļegs Čapligins, Imants Černovs, Dmitrijs Galočkins
 *
 * cBackup is free software: you can redistribute it and/or modify it
 * under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace app\modules\log\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\search\LogNodeSearch;
use app\models\LogNode;
use app\models\User;
use app\models\Severity;


/**
 * @package app\modules\log\controllers
 */
class NodelogController extends Controller
{

    /**
     * @var string
     */
    public $defaultAction = 'list';


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }


    /**
     * Render scheduler logs
     * @return string
     */
    public function actionList()
    {
        $searchModel  = new LogNodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'users'        => (new User())->getUsers('name'),
            'severities'   => ArrayHelper::map(Severity::find()->all(), 'name', 'name'),
            'actions'      => LogNode::find()->select('action')->indexBy('action')->asArray()->column()
        ]);
    }

}
