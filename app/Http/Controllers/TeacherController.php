<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherStoreRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari input
        $search = $request->input('search');

        // Query untuk mendapatkan data teachers dengan eager loading
        $teachers = Teacher::with('user') // Eager load user untuk menghindari N+1
            ->when($search, function ($query) use ($search) {
                // Lakukan pencarian berdasarkan nama atau email pengguna
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('identity_no', 'like', "%{$search}%");
                });
            })
            ->paginate(10); // Pagination 10 item per halaman

        return view('teacher.index', [
            'teachers' => $teachers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherStoreRequest $request)
    {
        $data = $request->validated();

        $checkTeacher = User::where('email',$data['email'])->first();
        if ($checkTeacher) {
            return redirect()->route('teacher.create')->with('error','Email sudah terdaftar');
        }

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('teacher', 'public');
            $data['photo'] = $imagePath;
        }
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt(123),
            'identity_no' => $data['identity_no'],
            'phone' => $data['phone'],
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'photo' => $data['photo'],
        ]);

        $user->assignRole('teacher');

        return redirect()->route('teacher.index')->with('success','Data guru berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.show',[
            'teacher' => $teacher,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
