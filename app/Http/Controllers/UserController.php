<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\log;
use App\Models\Userbendungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
	// public function index()
	// {
	// 	// mengambil data dari table user
	// 	$data['user'] = DB::table('ref_user')->get();
	// 	return view('master.user', $data);
	// }

	public function index()
	{
		// mengambil data dari table user
		$data['user'] = DB::table('ref_user')
		->Join('ref_role', 'ref_user.id_role', '=', 'ref_role.id_role')
		->get();
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
		$data->updated_by = session('nama');
		$data->save();
		return redirect('/user');
	}

	// TAMBAH
	public function tambah()
	{
		$data['jabatan'] = Role::all()->sortBy('nama_role');
		return view('register.register', $data);
	}

	public function store(Request $request)
	{
		$id_log = Str::uuid();
		$id_user =Str::uuid();
		$check = Userbendungan::where('id_role', $request->id_role)->count();
		try {
			if ($check > 0) {
				return redirect(('/user'))->with('error', 'Jabatan sudah digunakan');
			}else {
				DB::table('ref_user')->insert([
					'id_user' => $id_user,
					'nama' => $request->nama,
					'email' => $request->email,
					'hp' => $request->no_hp,
					'username' => $request->username,
					'password' => Hash::make($request->password),
					'id_role' => $request->id_role,
					'total_device' => '1',
					'created_at' => date('Y-m-d H:i:s.U'),
					'created_by' => session('nama')
				]);

				DB::table('log')->insert([
					'id_user' => $id_user,
					'id_log' => $id_log,
					'created_at' => date('Y-m-d H:i:s.U'),
					'created_by' => session('nama')
				]);
			}
			
		} catch (Exception $e) {
			
		}
		

        // $this->whatsappNotification($request->no_hp);

        return redirect(('/user'))->with('success', 'Data Tersimpan');
	}

	// HAPUS
	public function hapus($id)
	{
		try {
			DB::table('ref_user')->where('id_user', decrypt($id))->delete();
			return redirect(('/user'))->with('success', 'Data Terhapus');
		} catch (Exception $e) {
			return redirect(('/user'))->with('error', $e->getMessage());
		}
	}

    private function whatsappNotification(string $recipient)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $recipient,
                'message' => 'DoIT',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: VKV@d+tb1541aPL7nJDu'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
         dd($response);
    // // Update the path below to your autoload.php,
    // // see https://getcomposer.org/doc/01-basic-usage.md
    // require_once '/path/to/vendor/autoload.php';
    // use Twilio\Rest\Client;

    // $sid    = "ACc001269416433eeb49d452db323c0fe8";
    // $token  = "7bded9fed0b8cfc54826bf825de03cc1";
    // $twilio = new Client($sid, $token);

    // $message = $twilio->messages
    //   ->create("whatsapp:+628563498050", // to
    //     array(
    //       "from" => "whatsapp:+14155238886",
    //       "body" => Your appointment is coming up on July 21 at 3PM
    //     )
    //   );


    // $sid    = "ACc001269416433eeb49d452db323c0fe8";
    // $token  = "7bded9fed0b8cfc54826bf825de03cc1";
    // $wa_from = "+14155238886";
    // // $sid    = getenv("TWILIO_AUTH_SID");
    // // $token  = getenv("TWILIO_AUTH_TOKEN");
    // // $wa_from = getenv("TWILIO_WHATSAPP_FROM");
    // $twilio = new Client($sid, $token);

    // $body = "Halo ini DoIT from Benny Eka.";
    // // dd($twilio->messages->create("whatsapp:$recipient", ["from" => "whatsapp:$wa_from", "body" => $body]));

    // return $twilio->messages->create("whatsapp:$recipient", ["from" => "whatsapp:$wa_from", "body" => $body]);
    // dd($twilio->message->sid);
    }
}
