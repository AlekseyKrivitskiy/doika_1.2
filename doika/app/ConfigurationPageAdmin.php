<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doika_configuration;

class ConfigurationPageAdmin extends Model
{
    //��������� ����� ������������
    static public function getConfiguration($configurationName,$getString){
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
        // получаем цвет фона верхнего баннера
        $configurations['color_top_banner'] = self::getConfiguration('color_top_banner',true);
        // получаем цвет кнопки "Дапамагчы"
        $configurations['color_button_help'] = self::getConfiguration('color_button_help',true);
        // получаем цвет кнопок с суммами
        $configurations['color_button_amount'] = self::getConfiguration('color_button_amount',true);
        
        
        
        // ������ ������� ������ � ��������������
        
        return $configurations; 
    }
    
    //��������� ������������ ��� ���������� �����
    static public function createOrUpdateConfigurations($request){
        
       self::createOrUpdateConfiguration('token',$request->token);
       self::createOrUpdateConfiguration('id_market',$request->id_market);
       self::createOrUpdateConfiguration('key_market',$request->key_market);
       self::createOrUpdateConfiguration('color',$request->color);
       self::createOrUpdateConfiguration('color_top_banner',$request->color_top_banner);
       self::createOrUpdateConfiguration('color_button_help',$request->color_button_help);
       self::createOrUpdateConfiguration('color_button_amount',$request->color_button_amount);
    }
    
    
    
}
