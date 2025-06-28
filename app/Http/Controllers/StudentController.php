<?php

namespace App\Http\Controllers;

use App\Enum\DocumentTypeEnum;
use App\Http\Requests\StudentsRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
//        $student = Student::all(['id','name', 'lastname', 'age', 'document', 'course']);
        try {
            $student = Student::select([
                'id',
                'name',
                'lastname',
                'age',
                'document',
                'course'
            ])->get();
            return response()->json([
                "status" => 200,
                "data" => $student
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error fetching students: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): JsonResponse
    {
        $student = Student::findOrFail($id, ['id', 'name', 'lastname', 'age', 'document', 'course']);
        return response()->json([
            "status" => 200,
            "data" => $student
        ], Response::HTTP_OK);
    }

    /**
     * @param StudentsRequest $request
     * @return JsonResponse
     */
    public function store(StudentsRequest $request): JsonResponse
    {
//        $student = Student::create($request->all());
        try {
            DB::transaction(/*function () use ($request) {}*/);
            $student = new Student();

            $student->name = $request->name;
            $student->lastname = $request->lastname;
            $student->age = $request->age;
            $student->document = $request->document;
            $student->course = $request->course;

            $student->save();

            Student::create($request->all()); // alternative way to create a student


            DB::commit();
            return response()->json([
                'status' => 201,
                'student' => $student
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Error creating student: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id): mixed
    {
        try {
            $student = Student::findOrFail($id);
            $payload = [
                'name' => isset($request->name) ?  $request->name : $student->name,
                'lastname' => isset($request->name) ?  $request->lastname : $student->lastname,
                'age' => isset($request->age) ?  $request->age : $student->age,
                'document' => isset($request->document) ?  $request->document : $student->document,
                'course' => isset($request->course) ?  $request->course : $student->course,
            ];
//        dd($student); // die dom
            $student->update($payload);
//        $student->update([
//            'name' => $request->name,
//        ]);

            return response()->json([
                'status' => 200,
                'data' => $student
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating student: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();

            return response()->json([
                'message' => 'success',
            ], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error deleting student: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getDocumentTypes(): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'data' => DocumentTypeEnum::getDocumentType()
        ], Response::HTTP_OK);
    }
}
