<?php
namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class UserHrController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('file'));
            return redirect()->back()->with('success', 'Users imported successfully.');
        } catch (\Exception $e) {
            Log::error('Import Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to import users. Please check the log for more details.');
        }
    }

    public function index()
    {
        $users = $this->userRepo->all();
        return view('web.data_hr.index', compact('users'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportSelected(Request $request)
    {
        $selectedUsers = $request->input('selected_users', []);

        if (empty($selectedUsers)) {
            return redirect()->back()->with('error', 'No users selected for export.');
        }

        return Excel::download(new UsersExport($selectedUsers), 'selected_users.xlsx');
    }
}

