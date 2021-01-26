<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Karyawan;
use App\Models\Pendidikan;
use App\Models\PengalamanKerja;

class MainController extends Controller
{ 
    
    public function index()
    {
        $karyawan = Karyawan::latest()->paginate(5);

        return view('main.index', compact('karyawan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function create()
    {
        return view('main.create');
    }
    
    public function store(Request $request)
    {
        $post = $request->all();

        $create_karyawan = array(
            "nama"=>$post['nama'],
            "alamat"=>$post['alamat'],
            "no_ktp"=>$post['no_ktp'],
        );
        
        $karyawan = new Karyawan();
        DB::beginTransaction();
        try {   
            if ($karyawan->validate($create_karyawan))
            {
                // success code
                $karyawan = $karyawan->create($create_karyawan);
                
                for ($i=0; $i < count($post['nama_sekolah']); $i++) { 
                    $create_pendidikan = array(
                        "karyawan_id"=>$karyawan->id,
                        "nama_sekolah"=>$post['nama_sekolah'][$i],
                        "jurusan"=>$post['jurusan'][$i],
                        "tahun_masuk"=>$post['tahun_masuk'][$i],
                        "tahun_lulus"=>$post['tahun_lulus'][$i],
                    );
    
                    $pendidikan = new Pendidikan();
                    if ($pendidikan->validate($create_pendidikan))
                    {
                        // success code
                        $pendidikan->create($create_pendidikan);
                    }
                    else
                    {
                        return redirect()->route('main.edit', $karyawan->id)
                            ->withErrors($pendidikan->errors());
                    }
                }
    
                for ($i=0; $i < count($post['perusahaan']); $i++) { 
                    $create_pendidikan = array(
                        "karyawan_id"=>$karyawan->id,
                        "perusahaan"=>$post['perusahaan'][$i],
                        "jabatan"=>$post['jabatan'][$i],
                        "tahun"=>$post['tahun'][$i],
                        "keterangan"=>$post['keterangan'][$i],
                    );
                    
                    $pengalaman = new PengalamanKerja();
                    if ($pengalaman->validate($create_pendidikan))
                    {
                        // success code
                        $pengalaman->create($create_pendidikan);
                    }
                    else
                    {
                        return redirect()->route('main.edit', $karyawan->id)
                            ->withErrors($pengalaman->errors());
                    }
                }
            }
            else
            {
                return redirect()->route('main.create')
                    ->withErrors($karyawan->errors());
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('main.index')
            ->with('success', 'Karyawan Berhasil Di Buat.');
    }
    
    public function edit($id)
    {
        $karyawan = Karyawan::where('id',$id)->first();
        $pendidikan = Pendidikan::where('karyawan_id',$id)->get();
        $pengalaman = PengalamanKerja::where('karyawan_id',$id)->get();

        return view('main.edit', array(
            'karyawan'=>$karyawan,
            'pendidikan'=>$pendidikan,
            'pengalaman_kerja'=>$pengalaman,
        ));
    }
    
    public function update(Request $request, $id)
    {
        $post = $request->all();

        $update_karyawan = array(
            "nama"=>$post['nama'],
            "alamat"=>$post['alamat'],
            "no_ktp"=>$post['no_ktp'],
        );

        $karyawan = new Karyawan();
        DB::beginTransaction();
        try { 
            if ($karyawan->validate($update_karyawan))
            {
                // success code
                $karyawan->where('id',$id)->update($update_karyawan);
            }
            else
            {
                return redirect()->route('main.edit', $id)
                    ->withErrors($karyawan->errors());
            }

            for ($i=0; $i < count($post['pendidikan_id']); $i++) { 
                $update_pendidikan = array(
                    "karyawan_id"=>$id,
                    "nama_sekolah"=>$post['nama_sekolah'][$i],
                    "jurusan"=>$post['jurusan'][$i],
                    "tahun_masuk"=>$post['tahun_masuk'][$i],
                    "tahun_lulus"=>$post['tahun_lulus'][$i],
                );

                $pendidikan = new Pendidikan();
                if ($pendidikan->validate($update_pendidikan))
                {
                    // success code
                    $pendidikan->where('id',$post['pendidikan_id'][$i])->update($update_pendidikan);
                }
                else
                {
                    return redirect()->route('main.edit', $id)
                        ->withErrors($pendidikan->errors());
                }
            }

            for ($i=0; $i < count($post['pengalaman_id']); $i++) { 
                $update_pengalaman = array(
                    "karyawan_id"=>$id,
                    "perusahaan"=>$post['perusahaan'][$i],
                    "jabatan"=>$post['jabatan'][$i],
                    "tahun"=>$post['tahun'][$i],
                    "keterangan"=>$post['keterangan'][$i],
                );
                
                $pengalaman = new PengalamanKerja();
                if ($pengalaman->validate($update_pengalaman))
                {
                    // success code
                    $pengalaman->where('id',$post['pengalaman_id'][$i])->update($update_pengalaman);
                }
                else
                {
                    return redirect()->route('main.edit', $id)
                        ->withErrors($pengalaman->errors());
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('main.index')
            ->with('success', 'Karyawan updated successfully');
    }
    
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $karyawan = Karyawan::where('id',$id)->delete();
            $pendidikan = Pendidikan::where('karyawan_id',$id)->delete();
            $pengalaman = PengalamanKerja::where('karyawan_id',$id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('main.index')
            ->with('success', 'Karyawan deleted successfully');
    }
 
}

?>