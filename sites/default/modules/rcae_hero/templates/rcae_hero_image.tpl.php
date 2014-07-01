<?php

/**
 * @return bool
 */
function is_recipe() {
  $arg0 = arg(0);
  $arg1 = arg(1);
  if(isset($arg0) && is_numeric($arg1)) {
    return true;
  } else {
    return false;
  }
}



if(is_recipe()) {

//  dsm(arg(1));

  $result = db_select('node','n')
    ->fields('n', array('nid', 'title', 'created'))
    ->condition('n.type','recipe')
    ->condition('n.status', 0,'>')
    ->condition('n.nid', arg(1),'=')
    //->orderBy('n.nid','DESC')
    //->range(0,1)
    ->execute()
//  ->fetchAll();
    ->fetchAssoc();

  if( isset($result) ) {

    $node = node_load($result['nid']);

    $hero = $node->field_recipe_hero_image['und'][0]['uri'];

    drupal_add_js(array('rcae_hero_image' => array('hero_image' => file_create_url($hero))), 'setting');

  }

} else {
// Fetch 1 row
  $result = db_select('node','n')
    ->fields('n', array('nid', 'title', 'created'))
    ->condition('n.type','recipe')
    ->condition('n.status', 0,'>')
    ->orderBy('n.nid','DESC')
    ->range(0,1)
    ->execute()
//  ->fetchAll();
    ->fetchAssoc();

  if( isset($result) ) {

    $node = node_load($result['nid']);
//    dsm($node);

    $hero = $node->field_recipe_hero_image['und'][0]['uri'];

    drupal_add_js(array('rcae_hero_image' => array('hero_image' => file_create_url($hero))), 'setting');

//    drupal_add_js(array('YOURMODULE' => array('testvar' => $testvar)), array('type' => 'setting'));
//    alert(Drupal.settings.YOURMODULE.testvar);


  }

}

?>

