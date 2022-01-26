<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('karyawan.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo_profile' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $employee = new Employee;
        $employee->full_name = $request->full_name;
        $employee->gender = $request->gender;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->current_salary = $request->current_salary;
        $employee->photo_profile = $this->uploadProfile($request);
        $employee->save();

        return redirect('/karyawan');
    }

    /**
     * Function for handle upload image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string $fileName
     */
    protected function uploadProfile($request)
    {
        $file = $request->file('photo_profile');
        $fileName = time().'.'.$file->getClientOriginalName();
        $folder = 'photo_profile';
        $file->move($folder, $fileName);

        return $fileName;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        $employee->current_salary = $this->idrFormat($employee->current_salary);
        return view('karyawan.details', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('karyawan.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->full_name = $request->full_name;
        $employee->gender = $request->gender;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->current_salary = $request->current_salary;
        if (isset($request->photo_profile)) {
            $employee->photo_profile = $this->uploadProfile($request);
        }
        $employee->save();

        return redirect('/karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect('/karyawan');
    }

    public function wordExport($id)
    {
        $employee = Employee::findOrFail($id);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $source = 'photo_profile/'.$employee->photo_profile;
        $fileContent = file_get_contents($source);

        $rows = 10;
        $cols = 5;
        $headerCellFontStyle = array(
            'color'       => 'black',
            'bold'        => true,
            'lineHeight'  => 1.5
        );
        $bodyCellFontStyle = array(
            'color'       => 'black',
            'lineHeight'  => 1.5
        );
        $headerCellStyle = array(
            'bgColor'     => 'cccccc',
            'borderColor' => 'black',
            'borderSize'  => 6,
            'cellMargin'  => 50
        );
        $cellStyle = array(
            'borderColor' => 'black',
            'borderSize'  => 6,
            'cellMargin'  => 50
        );
        $table = $section->addTable();
        $table->addRow(200);
        $table->addCell(1500, $headerCellStyle)->addText('Field', $headerCellFontStyle);
        $table->addCell(3000, $headerCellStyle)->addText('Value', $headerCellFontStyle);
        $table->addRow(200);
        $table->addCell(1500, $cellStyle)->addText('Nama', $bodyCellFontStyle);
        $table->addCell(3000, $cellStyle)->addText($employee->full_name);
        $table->addRow(200);
        $table->addCell(1500, $cellStyle)->addText('Jenis Kelamin', $bodyCellFontStyle);
        if ($employee->gender == 1) {
            $gender = 'Laki-laki';
        } else {
            $gender = 'Perempuan';
        }
        $table->addCell(3000, $cellStyle)->addText($gender);
        $table->addRow(200);
        $table->addCell(1500, $cellStyle)->addText('Nomor HP', $bodyCellFontStyle);
        $table->addCell(3000, $cellStyle)->addText($employee->phone);
        $table->addRow(200);
        $table->addCell(1500, $cellStyle)->addText('Email Aktif', $bodyCellFontStyle);
        $table->addCell(3000, $cellStyle)->addText($employee->email);
        $table->addRow(200);
        $table->addCell(1500, $cellStyle)->addText('Current Salary', $bodyCellFontStyle);
        $table->addCell(3000, $cellStyle)->addText($this->idrFormat($employee->current_salary));
        $table->addRow(200);
        $table->addCell(1500, $cellStyle)->addText('Foto Profil', $bodyCellFontStyle);
        $table->addCell(3000, $cellStyle)->addImage($fileContent, array('width' => 60,'height'=> 80));

        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('temporary_file/'.$employee->full_name.'.docx');
        return response()->download(public_path('temporary_file/'.$employee->full_name.'.docx'));
    }

    /**
     * Function for handle conver string format to idrFormat.
     *
     * @param  String $amount
     * @return string
     */
    protected function idrFormat($amount)
    {
        return 'Rp ' . strrev(implode(',', str_split(strrev(strval($amount)), 3)));
    }
}
