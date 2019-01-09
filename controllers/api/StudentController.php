<?php

namespace app\controllers\api;

use Yii;
use app\models\Student;
use app\models\StudentSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

/**
 * Class StudentController
 * @package app\controllers\api
 */
class StudentController extends ActiveController
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
     * @SWG\Get(path="/api/student/?student_id={id}&last_name={last_name}&first_name={first_name}",
     *     tags={"Student"},
     *     summary="Get student.",
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         type="string",
     *         description="student id",
     *         required=false,
     *         allowEmptyValue=true
     *     ),
     *     @SWG\Parameter(
     *         name="last_name",
     *         in="query",
     *         type="string",
     *         description="last name",
     *         required=false,
     *         allowEmptyValue=true
     *     ),
     *     @SWG\Parameter(
     *         name="first_name",
     *         in="query",
     *         type="string",
     *         description="first name",
     *         required=false,
     *         allowEmptyValue=true
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Student response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref = "#/definitions/StudentsWithLessons"),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response = 401,
     *         description = "Unauhorized",
     *     ),
     * )
     *
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(["StudentSearch" => Yii::$app->request->queryParams]);

        return $dataProvider->query
            ->asArray()
            ->all();
    }

    /**
     * @SWG\Post(path="/api/student/create",
     *     tags={"Student"},
     *     summary="Create Student.",
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
     * Creates a new Student
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if (!$model->load(Yii::$app->request->post(), '')) {
            return ['status' => $model->getErrors()];
        }
        if($model->validate() && $model->save()) {
            return ['status' => 1];
        }

        return ['status' => $model->getErrors()];
    }

    /**
     * @SWG\Put(path="/api/student/update/{studentId}",
     *     tags={"Student"},
     *     summary="Update course.",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(name="body", in="body", required=true,
     *         @SWG\Schema(
     *            @SWG\Property(property="first_name", type="string", example="Some title"),
     *            @SWG\Property(property="last_name", type="string", example="Some description"),
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
     * @param integer $studentId
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($studentId)
    {
        $model = $this->findModel($studentId);

        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->save()) {
            return ['status' =>  1];
        }

        return ['status' => $model->getErrors()];
    }

    /**
     * @SWG\Delete(path="/api/student/delete/{studentId}",
     *     tags={"Student"},
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
    public function actionDelete($studentId)
    {
        try {
            $code = $this->findModel($studentId)->delete();

            return ['status' => $code];
        } catch (Exception $e) {

            Yii::$app->response->headers->add('Access-Control-Allow-Origin' , '*');
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
