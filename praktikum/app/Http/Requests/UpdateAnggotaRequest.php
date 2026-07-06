<?php
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
 
class UpdateAnggotaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Mengambil ID anggota langsung dari parameter URL Route Laravel
        $anggotaId = $this->route('anggotum') ?? $this->route('anggota');

        return [
            // PERBAIKAN: Abaikan ID anggota ini dari pengecekan unique database
            'kode_anggota'   => 'required|unique:anggota,kode_anggota,' . $anggotaId,
            'email'          => 'required|email|unique:anggota,email,' . $anggotaId,
            
            'nama'           => 'required|string|max:255',
            'telepon'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'alamat'         => 'required|string',
            'tanggal_lahir'  => 'required|date|before:today',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'pekerjaan'      => 'nullable|string|max:100',
            'tanggal_daftar' => 'required|date',
            'status'         => 'required|in:Aktif,Nonaktif',
        ];
    }
 
    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'kode_anggota.unique' => 'Kode anggota sudah digunakan.',
            'email.unique' => 'Email sudah terdaftar.',
            'telepon.regex' => 'Format nomor telepon tidak valid. Contoh: 081234567890',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'tanggal_daftar.before_or_equal' => 'Tanggal pendaftaran tidak boleh di masa depan.',
        ];
    }
}