<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Userbendungan;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function index()
	{
		// mengambil data dari table user
		$data['user'] = DB::table('ref_user')->get();
		return view('master.user', $data);
	}

	public function edit($id_user)
	{
		$id = decrypt($id_user);
		$data = Userbendungan::find($id);
		return view('edit.user', compact(['data']));
	}

	public function proses(Request $request)
	{
		$data = Userbendungan::find($request->id_user);
		$data->nama = $request->nama;
		$data->email = $request->email;
		$data->hp = $request->no_hp;
		$data->username = $request->username;
		$data->password = $request->password;
		$data->role = $request->role;
		$data->updated_by = session('id_user');
		$data->save();
		return redirect('/user');
	}

	// TAMBAH
	public function tambah()
	{
		return view('register.register');
	}

	public function store(Request $request)
	{
		DB::table('ref_user')->insert([
			'nama' => $request->nama,
			'email' => $request->email,
			'hp' => $request->no_hp,
			'username' => $request->username,
			'password' => Hash::make($request->password),
			'role' => $request->jabatan,
			'created_at' => date('Y-m-d H:i:s.U'),
			'created_by' => session('nama')
		]);

        // $this->whatsappNotification($request->no_hp);

		return redirect('/user');
	}

	// HAPUS
	public function hapus($id)
	{
		try {
			DB::table('ref_user')->where('id_user', $id)->delete();
			return redirect(('/user'))->with('success', 'Data Terhapus');
		} catch (Exception $e) {
			return redirect(('/user'))->with('error', $e->getMessage());
		}
	}

    private function whatsappNotification(string $recipient)
    {
        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from = getenv("TWILIO_WHATSAPP_FROM");
        $twilio = new Client($sid, $token);

        $body = "Halo ini DoIT from Benny Eka.";
        dd($twilio->messages->create("whatsapp:$recipient", ["from" => "whatsapp:$wa_from", "body" => $body]));

        return $twilio->messages->create("whatsapp:$recipient", ["from" => "whatsapp:$wa_from", "body" => $body]);
    }
}
