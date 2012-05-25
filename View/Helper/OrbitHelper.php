<?php

class OrbitHelper extends AppHelper {

	var $helpers = array(
		'Html',
		'Js',
		'Gallery.Gallery',
		);

	function assets($options = array()) {
	}

	function album($album, $photos) {
		$galleryId = 'gallery' . Inflector::camelize($album['Album']['slug']);
		$result = $this->Html->tag('div', $photos, array(
			'id' => $galleryId,
			));
		return $result;
	}

	function photo($album, $photo) {
		$urlLarge = $this->Html->url('/' . $photo['large']);
		$urlSmall = $this->Html->url('/' . $photo['small']);
		$urlOriginal = $this->Html->url('/' . $photo['original']);
		$result = $this->Html->image($urlOriginal);
		return $result;
	}

	function initialize($album) {
		//$config = $this->Gallery->getAlbumJsParams($album);
		$config = '{bullets: true, directionalNav: false, timer: false}';
		$param = str_replace('"', '', $config);
		$galleryId = 'gallery' . Inflector::camelize($album['Album']['slug']);

		$js = sprintf('$(\'#%s\').orbit(%s);',
			$galleryId,
			$config
			);
		$this->Js->buffer($js);
	}

}
