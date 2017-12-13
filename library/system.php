<?php
	class System{
		public $site;
		public $channel;
		public $page;
		public $content;

		function __construct($url){
			/*preg_match("/[-a-zA-Z0-9]+/g", $url) xor $url==null*/
			if (true) {
				$this->site = new SimpleXMLElement(file_get_contents('data/site.xml'));
				if ($url==null) {
					$this->content = "<video id=nesiatv class='video-js' controls><source src='".$this->site->stream."' type='application/x-mpegURL'></video><script>var player = videojs('nesiatv');player.play();</script><div id='content'><h1>".$this->site->title." ".$this->site->category."</h1><p>".$this->site->body."</p></div>";
				} elseif ($this->endsWith($url,"-live-streaming")) {
					$url = substr($url, 0 , -15);
					$this->channel = new SimpleXMLElement(file_get_contents('data/channel.xml'));
					$this->channel = $this->channel->xpath('//channel[url="'.$url.'"]');
					$this->site->title = $this->channel[0]->title;
					$this->site->description = $this->channel[0]->description;
					$this->site->keywords = $this->channel[0]->keywords;
					$this->content = "<video id=nesiatv class='video-js' controls><source src='".$this->channel[0]->stream."' type='application/x-mpegURL'></video><script>var player = videojs('nesiatv');player.play();</script><div id='content'><h1>".$this->channel[0]->title." ".$this->channel[0]->category."</h1><p>".$this->channel[0]->body."</p></div>";
				} else {
					$this->page = new SimpleXMLElement(file_get_contents('data/pages.xml'));
					$this->page = $this->page->xpath('//page[url="'.$url.'"]');
					$this->site->title = $this->page[0]->title;
					$this->site->description = $this->page[0]->description;
					$this->site->keywords = $this->page[0]->keywords;
					$this->content = "<div id='content'><h1>".$this->page[0]->title."</h1><p>".$this->page[0]->body."</p></div>";
				}
			} else {
				echo "tidak valid";
			}
		}

		function getChannels(){
			$pullchannels = new SimpleXMLElement(file_get_contents('data/channel.xml'));
			foreach ($pullchannels->children() as $channel) {
				echo "<li><a href=\"".$this->site->baseurl."$channel->url"."-live-streaming"."\" title=\"Watch $channel->title Live Streaming\"$channel->title\">$channel->title</a></li>";
			}
		}

		function getPages(){
			$pullpages = new SimpleXMLElement(file_get_contents('data/pages.xml'));
			foreach ($pullpages->children() as $page) {
				echo "<li><a href='".$this->site->baseurl."".$page->url."' title=\"$page->title Live Streaming\">$page->title</a></li>";
			}
		}

		function endsWith($haystack, $needle) {
		    $length = strlen($needle);
		    if ($length == 0) {
		        return true;
		    }
		    return (substr($haystack, -$length) === $needle);
		}
	}
?>