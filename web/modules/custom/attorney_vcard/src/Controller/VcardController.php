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
		//name
        $name = $node->get('title')->getValue();
		//email
        $email = $node->get('field_email_id')->getString();
        $image_file_id = $node->get('field_image_a')->getValue();
		//phon no
        $telephone = $node->get('field_phon_')->getString();

		//fax 
		$fax = $node->get('field_fax')->getString();
		// file name
        //$nid = $node->get('nid')->getValue();
        $filename = $name[0]['value'].".vcf";


        $designation = $node->get('field_designation')->getString();
		echo $designation;
        

        // Get Image url
        $media = Media::load($image_file_id[0]['target_id']);
        if($media){
          $fid = $media->field_media_image->target_id;
          $file = File::load($fid);
          $image_url = $file->url();
        }
		// data print in vacrd format
		$fullname = $name[0]['value'];
        $data=null;
        $data.="BEGIN:VCARD\n";
		
        $data.="VERSION:3.0\n";
		
		$data.="FN:".$fullname."\n";
		
        $data.="TITLE:".$designation."\n";  
		$data.="EMAIL;type=INTERNET;type=WORK;type=pref:"  .$email."\n";
		$data.="TEL;TYPE=WORK:".$telephone."\n";
		
		$data.="TEL;TYPE=WORK;TYPE=FAX:".$fax."\n";	
		//Image print
        $data.="PHOTO;JPEG;ENCODING=BASE64:".base64_encode(file_get_contents($image_url))."\n";
        $data.="END:VCARD";

        $path = base_path();
        $fullpath =  $_SERVER['DOCUMENT_ROOT'].''.base_path();
		//$fullpath = \Drupal::request()->getSchemeAndHttpHost();
		$filePath = $fullpath."sites/default/files/vcard/".$filename;
        $redirection_path = base_path().'sites/default/files/vcard/'.$filename;
		$file = fopen($filePath,"w");
        fwrite($file,$data);
        fclose($file);   
         
        return new RedirectResponse($redirection_path);     
    }
  }
}

?>