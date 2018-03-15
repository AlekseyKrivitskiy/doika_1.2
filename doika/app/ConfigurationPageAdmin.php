<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doika_configuration;

class ConfigurationPageAdmin extends Model
{
    //��������� ����� ������������
    static private function getConfiguration($configurationName,$getString){
        $configuration = Doika_configuration::where('configuration_name',$configurationName)
                ->first(); 
        if($configuration && $getString){
           
                $configuration = $configuration->configuration_value;
            
        }
        return $configuration;
        
    }
    //�������� ��� ���������� ����� ������������
    static public function createOrUpdateConfiguration($configurationName,$value){
        
        if(!$value){
            $value = "";
        }
        $configuration = self::getConfiguration($configurationName,false);
        if($configuration){
            $configuration->configuration_value = $value;
            $configuration->save();
        }else{
            $configuration = new Doika_configuration;
            $configuration->configuration_name = $configurationName;
            $configuration->configuration_value = $value;
            $configuration->configuration_active = 1;
            $configuration->save();
            
        }
        
    }

    static public function getConfigurations(){
        //������� ������ ������������
        $configurations = [];
        // �������� ���� ���� �� ����������
        $configurations['token'] = self::getConfiguration('token',true);
        
        //�������� IdMarket
        $configurations['id_market'] = self::getConfiguration('id_market',true);
        //�������� KeyMarket
        $configurations['key_market'] = self::getConfiguration('key_market',true);
        // �������� ���� ������
        $configurations['color'] = self::getConfiguration('color',true);
        
        
        
        
        // ������ ������� ������ � ��������������
        
        return $configurations; 
    }
    
    //��������� ������������ ��� ���������� �����
    static public function createOrUpdateConfigurations($request){
        
       self::createOrUpdateConfiguration('token',$request->token);
       self::createOrUpdateConfiguration('id_market',$request->id_market);
       self::createOrUpdateConfiguration('key_market',$request->key_market);
       self::createOrUpdateConfiguration('color',$request->color);
    }
    
    
    
}
