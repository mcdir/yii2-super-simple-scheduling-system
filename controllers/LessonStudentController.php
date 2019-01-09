<?php

namespace app\controllers;

use Yii;
use app\models\LessonStudent;
use app\models\LessonStudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LessonStudentController implements the CRUD actions for LessonStudent model.
 */
class LessonStudentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LessonStudent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LessonStudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LessonStudent model.
     * @param integer $lesson_id
     * @param integer $student_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($lesson_id, $student_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($lesson_id, $student_id),
        ]);
    }

    /**
     * Creates a new LessonStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LessonStudent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LessonStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $lesson_id
     * @param integer $student_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($lesson_id, $student_id)
    {
        $model = $this->findModel($lesson_id, $student_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'lesson_id' => $model->lesson_id, 'student_id' => $model->student_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LessonStudent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $lesson_id
     * @param integer $student_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($lesson_id, $student_id)
    {
        $this->findModel($lesson_id, $student_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LessonStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $lesson_id
     * @param integer $student_id
     * @return LessonStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($lesson_id, $student_id)
    {
        if (($model = LessonStudent::findOne(['lesson_id' => $lesson_id, 'student_id' => $student_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
