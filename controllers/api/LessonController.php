<?php

namespace app\controllers\api;

use Yii;
use app\models\Lesson;
use app\models\LessonSearch;
use yii\rest\ActiveController;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends ActiveController
{
    /**  @var string    */
    public $modelClass = '';

    /**
     * @return array
     */
    public function actions()
    {
        return [];
    }

    /**
     * @SWG\Get(path="/api/lesson/?lesson_id={lesson_id}&title_about={title_about}",
     *     tags={"Lesson"},
     *     summary="Get lesson.",
     *     @SWG\Parameter(
     *         name="lesson_id",
     *         in="query",
     *         type="string",
     *         description="lesson id",
     *         required=false,
     *         allowEmptyValue=true
     *     ),
     *     @SWG\Parameter(
     *         name="title_about",
     *         in="query",
     *         type="string",
     *         description="Title about",
     *         required=false,
     *         allowEmptyValue=true
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Student response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref = "#/definitions/Lesson"),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "Unauhorized",
     *     ),
     * )
     *
     * Lists all Lesson models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LessonSearch();

        $dataProvider = $searchModel->search(["LessonSearch" => Yii::$app->request->queryParams]);

        return $dataProvider->query
            ->asArray()
            ->all();
    }

    /**
     * @SWG\Post(path="/api/lesson/create",
     *     tags={"Lesson"},
     *     summary="Create Lesson.",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(name="body", in="body", required=true,
     *          @SWG\Schema(ref = "#/definitions/Student")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "success",
     *         @SWG\Schema(
     *             @SWG\Property(property="status", type="string", example="1"),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "Unauhorized",
     *     ),
     * )
     *
     * Creates a new Lesson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lesson();

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return ['status' => $model->code];
        }

        return ['status' => 'error'];
    }

    /**
     * @SWG\Put(path="/api/lesson/update/{lessonId}",
     *     tags={"Lesson"},
     *     summary="Update lesson.",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(name="body", in="body", required=true,
     *         @SWG\Schema(
     *            @SWG\Property(property="title", type="string", example="Some title"),
     *            @SWG\Property(property="description", type="string", example="Some description"),
     *        ),
     *     ),
     *     @SWG\Parameter(
     *         description="student id",
     *         in="path",
     *         name="studentId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "success",
     *         @SWG\Schema(
     *             @SWG\Property(property="status", type="string", example="1"),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "Unauhorized",
     *     ),
     * )
     *
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $lessonId
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($lessonId)
    {
        $model = $this->findModel($lessonId);

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return ['status' => $model->code];
        }

        return ['status' => 'error'];
    }

    /**
     * @SWG\Delete(path="/api/student/delete/{lessonId}",
     *     tags={"Lesson"},
     *     summary="Update student.",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(
     *         description="student id",
     *         in="path",
     *         name="studentId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "success",
     *         @SWG\Schema(
     *             @SWG\Property(property="status", type="string", example="1"),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "Unauhorized",
     *     ),
     * )
     *
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($lessonId)
    {
        $this->findModel($lessonId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lesson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lesson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lesson::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
