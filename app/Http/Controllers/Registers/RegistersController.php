<?php
namespace App\Http\Controllers\Registers;
use App\Http\Controllers\Controller;
use Flash;
use App\Models\clsBd;
use App\Models\Silog\Configuracion\Persona;
use App\Http\Requests\RegistersClientRequest;


class RegistersController extends Controller
{
    
    function __construct( clsBd $bd)
    {
        $this->bd  = $bd;
    }
    public function index()
    {      
        
        $arrData['table']='tb_tipo_doc_identificacion';                
        $arrData['fillable']=array('id_tipo_doc_identificacion','nom_tipo_doc_identificacion');
        $arrData['get'] = true;
        //$arrData['toSql'] = true;
        $resultado =  $this->bd->consultar($arrData);
        $arr_type_doc = ['0'=>'..Seleccione El Tipo De Documento..'] + collect($resultado)->pluck('nom_tipo_doc_identificacion', 'id_tipo_doc_identificacion')->toArray();
       
        return view('Registers.registers',compact('arr_type_doc'));
    }
    
    public function store(RegistersClientRequest $request){
        
        $data = $request->all();
        if(empty($data['txtNroIdentificacion'])){
            return response()->json(['ErrorBd' => 'El tipo de documento es obligatorio','TlErrorBd'=>'Error']);
        }
        
        $person = Persona::firstOrNew(
                    ['nro_identificacion' => $data['txtNroIdentificacion']]
        );
        
        if(empty($person->id_persona)){
            $person->id_usuario_cre = 10000;
        }else{
            $person->id_usuario_mod = 10000;
        }
        
        $person->nro_identificacion = $data['txtNroIdentificacion'];
        $person->id_tipo_doc_identificacion = $data['optIdType'];
        $person->nombre = $data['txtNombre'];
        
        if($data['optIdType'] == 6){
            $person->primer_apellido = null;
            $person->segundo_apellido = null;
            $person->id_tipo_persona = 1;
            
            if(empty($data['txtDigitoVerificacion']) && $data['txtDigitoVerificacion'] <> 0){
                return response()->json(['ErrorBd' => 'Ingrese el digito de verificacion','TlErrorBd'=>'Error']);
            }
            $person->digito_verificacion = $data['txtDigitoVerificacion'];
        }else{
            if(empty($data['txtPrimerApellido'])){
                return response()->json(['ErrorBd' => 'El primer apellido es obligatorio','TlErrorBd'=>'Error']);
            }
            $person->primer_apellido = (!empty($data['txtPrimerApellido']))?$data['txtPrimerApellido']: null;
            $person->segundo_apellido = (!empty($data['txtSegundoApellido']))?$data['txtSegundoApellido']: null;
            $person->id_tipo_persona = 2; //natural
            $person->digito_verificacion = null;
        }
        
        if(empty($data['txtEmail'])){
            return response()->json(['ErrorBd' => 'El correo es obligatorio','TlErrorBd'=>'Error']);
        }
            
        $person->e_mail = $data['txtEmail'];
        
        if(empty($data['txtEmail'])){
            return response()->json(['ErrorBd' => 'El correo es obligatorio','TlErrorBd'=>'Error']);
        }
        
        $person->celular = $data['txtPhoneNumber'];
        
        $person->save();
        if($person->save()){
            return response()->json(['status' => 'ok','mensaje' => 'creado satisfactoriamente']);
        }else{
            return response()->json(['ErrorBd' => 'Error al crear','TlErrorBd' => 'No se creo']);
        }
    }
}
