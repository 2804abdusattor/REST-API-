<?php
namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Notebook API",
 *     version="1.0.0",
 *     description="API для управления записной книжкой"
 * )
 *
 * @OA\Tag(name="Notebook", description="Методы работы с записной книжкой")
 */
class NotebookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/notebook",
     *     tags={"Notebook"},
     *     summary="Получить список записей",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Номер страницы",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Notebook"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        return Notebook::paginate(10);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/notebook",
     *     tags={"Notebook"},
     *     summary="Создать новую запись",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Notebook")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Успешно создано",
     *         @OA\JsonContent(ref="#/components/schemas/Notebook")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'company' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        return Notebook::create($validated);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/notebook/{id}",
     *     tags={"Notebook"},
     *     summary="Получить запись по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID записи",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(ref="#/components/schemas/Notebook")
     *     )
     * )
     */
    public function show($id)
    {
        return Notebook::findOrFail($id);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/notebook/{id}",
     *     tags={"Notebook"},
     *     summary="Обновить запись",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID записи",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Notebook")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно обновлено",
     *         @OA\JsonContent(ref="#/components/schemas/Notebook")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $notebook = Notebook::findOrFail($id);
        $validated = $request->validate([
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'company' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $notebook->update($validated);
        return $notebook;
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/notebook/{id}",
     *     tags={"Notebook"},
     *     summary="Удалить запись",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID записи",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Успешно удалено"
     *     )
     * )
     */
    public function destroy($id)
    {
        $notebook = Notebook::findOrFail($id);
        $notebook->delete();
        return response()->noContent();
    }
}
