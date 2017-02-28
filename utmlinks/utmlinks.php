<?php

defined( '_JEXEC' ) or die;

jimport( 'joomla.plugin.plugin' );

class plgContentUtmLinks extends JPlugin {

    protected $links = array(
        array(
            'label' => 'Viðbrögð við einelti',
            'url' => 'http://reykjavik.is/vinsamlegt-samfelag'
        ),
        array(
            'label' => 'Röskun á starfi vegna óveðurs',
            'url' => 'http://shs.is/index.php/fraedsla/roskun-a-skolastarfi/'
        ),
        array(
            'label' => 'Disruption of school operations',
            'url' => 'http://shs.is/index.php/fraedsla/disruption-of-school-operations/'
        )
    );

    public function onContentPrepare($context, &$article, &$params, $page=0) {
        if (strpos($article->text, '<div>{utmlinks}</div>') !== false) {
            $article->text = str_replace('<div>{utmlinks}</div>', $this->renderLinks(), $article->text);
        }
        if (strpos($article->text, '{utmlinks}') !== false) {
            $article->text = str_replace('{utmlinks}', $this->renderLinks(), $article->text);
        }
    }

    protected function renderLinks() {
        $content = array();
        foreach ($this->links as $link) {
            $content[] = '<div><a href="' . $link['url'] . '" target="_blank">' . $link['label'] . '</a></div>';
        }
        return implode('', $content);
    }
}