<?php

namespace Drupal\attorney_vcard\Controller;

use Drupal\node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\redirect\Entity\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\taxonomy\Entity\Term;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;




/**
 * Controller routines for AJAX routes.
 */
class VcardController extends ControllerBase {

  public function vcardFetch(NodeInterface $node) {

    if($node){
        $name = $node->get('title')->getValue();
        $email = $node->get('field_email_id')->getValue();
        $image_file_id = $node->get('field_image_a')->getValue();
        //$telephone = $node->get('field_telephone')->getValue();
        $nid = $node->get('nid')->getValue();
        $filename = $nid[0]['value'].".vcf";
        //$social = $node->get('field_linkedin_link')->getString();
        $designation = $node->get('field_designation')->getvalue();
        
        // Trim Social field
        //$social_link=trim($social);
        //$social_arr = explode (",", $social_link);  

        // Get designation from tid

        // Get Image url
        $media = Media::load($image_file_id[0]['target_id']);
        if($media){
          $fid = $media->field_media_image->target_id;
          $file = File::load($fid);
          $image_url = $file->url();
        }
		//dump($lname[0]['value']);
		//exit;
		$fullname = $name[0]['value'];
        $data=null;
        $data.="BEGIN:VCARD\n";
        $data.="VERSION:3.0\n";
		$data.="FN:".$fullname."\n";
        $data.="ORG:" ."Haight Brown Bonesteel". "\n";
        $data.="TITLE:".$designation."\n";    
        // $data.="TEL;WORK:".$telephone."\n";    
        $data.="EMAIL;TYPE=work:" .$email[0]['value']."\n";
        $data.="PHOTO;JPEG;ENCODING=BASE64:".base64_encode(file_get_contents($image_url))."\n";    
        //$data.="URL;type=pref:https://www.linkedin.com/".$social_arr[1]."\n";
        $data.="END:VCARD";

        $path = base_path();
        //$fullpath =  $_SERVER['DOCUMENT_ROOT'].''.base_path();
        $fullpath = "C:\xammp\htdocs\drupal-project\drupal-vm\drupal\web";
		$filePath = $fullpath."/sites/default/files/vcard/".$filename;
        $redirection_path = base_path().'/sites/default/files/vcard/'.$filename;
		$file = fopen($filePath,"w");
        fwrite($file,$data);
        fclose($file);   
         
        return new RedirectResponse($redirection_path);     
    }
  }
}

?>