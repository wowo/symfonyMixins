<?php
require_once(dirname(__FILE__). '/../../../lib/myMixins.class.php');

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    // connecting to built-in event component.method_not_found
    // more built-in events: http://www.symfony-project.org/book/1_2/17-Extending-Symfony#chapter_17_sub_built_in_events
    $this->dispatcher->connect('component.method_not_found', array(new myMixins(), 'listener'));
  }
}
