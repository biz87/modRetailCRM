<?php
if (!$RetailCrm = $modx->getService('RetailCrm','modretailcrm',MODX_CORE_PATH.'components/modretailcrm/model/modretailcrm/')) {
    $modx->log(1, '[RetailCrm] - Not found class RetailCrm');
    return;
} 
$site = $modx->getOption('modretailcrm_siteCode');
/** @var modX $modx */
switch ($modx->event->name) {
    case 'OnUserSave':
        // Save referrer id
        if ($mode == modSystemEvent::MODE_NEW) {
            /** @var modUser $user */
            if ($modx->context->key != 'mgr' ) {
                
                if ($profile = $modx->getObject('modUserProfile', $user->get('id'))) {
                    $customer = array();
                    $customer['externalId'] =  $user->get('id');
                    $customer['firstName'] = $profile->fullname;
                    $customer['email'] = $profile->email;
                    if(!empty($profile->phone)){
                        $customer['phones'][]['number'] = $profile->phone;
                    }
                    if(!empty($profile->mobilephone)){
                        $customer['phones'][]['number'] = $profile->mobilephone;
                    }
                    $response = $RetailCrm->customersCreate($customer, $site);  
                    
                }
                
            }
        }
        break;
    case 'msOnCreateOrder':
        $Address = $msOrder->getOne('Address');
        $orderData = array();
        $orderData['customer']['externalId'] = $Address->get('user_id');
        //Если пользователь еще не создан в CRM
        if ($profile = $modx->getObject('modUserProfile', $Address->get('user_id'))) {
            $customer = array();
            $customer['externalId'] =  $Address->get('user_id');
            $customer['firstName'] = $profile->fullname;
            $customer['email'] = $profile->email;
            if(!empty($profile->phone)){
                $customer['phones'][]['number'] = $profile->phone;
            }
            if(!empty($profile->mobilephone)){
                $customer['phones'][]['number'] = $profile->mobilephone;
            }
            $response = $RetailCrm->customersCreate($customer, $site);  
        }
        
        $orderData['externalId'] = $Address->get('id');
        $orderData['firstName'] = $Address->get('receiver');
        $orderData['phone'] = $Address->get('phone');
        $orderData['email'] = $Address->get('email');
        
        $Products = $msOrder->getMany('Products');
        
        $items = array();
        $key = 0;
        foreach ($Products as $pr) {
            $options = $pr->toArray();
            $orderData['items'][$key]['initialPrice'] = $pr->get('cost');
            $orderData['items'][$key]['purchasePrice'] = $pr->get('cost');
            $orderData['items'][$key]['productName'] = $pr->get('name');
            $orderData['items'][$key]['quantity'] = $pr->get('count');
            $orderData['items'][$key]['offer']['externalId'] = $pr->get('id');
            $key ++;
		}
        
        $fields = array(
            'index' => 'Индекс', 
            'country' => 'Страна', 
            'region' => 'Регион', 
            'city' => 'Город', 
            'metro' => 'Метро', 
            'street' => 'Улица', 
            'building' => 'Дом', 
            'room' => 'Квартира\офис',
            'comment' => 'Комментарий к адресу'
        );
        $address = '';
        foreach($fields as $field=>$comment){
            if(!empty($Address->get($field))){
                $address .= $comment.':'.$Address->get($field).' ';
                $orderData['delivery']['address'][$field] = $Address->get($field);
            }
        }
        $orderData['delivery']['address']['text'] = $address;
        $response = $RetailCrm->ordersCreate($orderData, $site);
        $modx->log(1, print_r($response));
        break;
}