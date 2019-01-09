<?php

namespace app\controllers\api;

use Yii;
use app\models\Course;
use app\models\CourseSearch;
use yii\rest\ActiveController;

/**
 * Class CourseController
 * @package app\controllers\api
 */
class CourseController extends ActiveController
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
     * @SWG\Get(path="/api/course/?code={code}&title={title}&description={description}",
     *     tags={"Course"},
     *     summary="Get/search course.",
     *     @SWG\Parameter(
     *         name="code",
     *         in="query",
     *         type="string",
     *         description="code",
     *         required=false,
     *         allowEmptyValue=true
     *     ),
     *     @SWG\Parameter(
     *         name="title",
     *         in="query",
     *         type="string",
     *         description="title",
     *         required=false,
     *         allowEmptyValue=true
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="description",
     *         required=false,
     *         allowEmptyValue=true
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "success",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref = "#/definitions/Course"),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "Unauhorized",
     *     ),
     * )
     *
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new courseSearch();
        $dataProvider = $searchModel->search(["CourseSearch" => Yii::$app->request->queryParams]);

        return $dataProvider->query
            ->asArray()
            ->all();
    }

    /**
     * @SWG\Post(path="/api/course/create",
     *     tags={"Course"},
     *     summary="Create course.",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(name="body", in="body", required=true,
     *          @SWG\Schema(ref = "#/definitions/Course")
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
     * Creates a new Course
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return ['status' => $model->code];
        }

        return ['status' => 'error'];
    }

    /**
     * @SWG\Put(path="/api/course/update/{courseId}",
     *     tags={"Course"},
     *     summary="Update course.",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(name="body", in="body", required=true,
     *         @SWG\Schema(
     *            @SWG\Property(property="title", type="string", example="Some title"),
     *            @SWG\Property(property="description", type="string", example="Some description"),
     *        ),
     *     ),
     *     @SWG\Parameter(
     *         description="course id",
     *         in="path",
     *         name="courseId",
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
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $courseId
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($courseId)
    {
        $model = $this->findModel($courseId);

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return ['status' => $model->code];
        }

        return ['status' => 'error'];
    }

    /**
     * @SWG\Delete(path="/api/course/delete/{courseId}",
     *     tags={"Course"},
     *     summary="Update course.",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(
     *         description="course id",
     *         in="path",
     *         name="courseId",
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
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($courseId)
    {
        $code = $this->findModel($courseId)->delete();

        return ['status' => $code];
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
