<?php

namespace Flow\Model;

use Html;
use Message;
use RawMessage;
use Title;

/**
 * Represents a mutable anchor as a Message instance along with
 * a title, query parameters, and a fragment.
 */
class Anchor {
	/**
	 * Message used for the text of the anchor
	 *
	 * @var Message
	 */
	protected $message;

	/**
	 * Message used for the HTML title attribute of the anchor
	 *
	 * @var Message $titleMessage
	 */
	protected $titleMessage;

	/**
	 * Page title the anchor points to (not to be confused with title attribute)
	 *
	 * @var Title
	 */
	public $title;

	/**
	 * @var array
	 */
	public $query = array();

	/**
	 * @var string
	 */
	public $fragment;

	/**
	 * @param Message|string $message Text content of the anchor
	 * @param Title $title Page the anchor points to
	 * @param array $query Query parameters for the anchor
	 * @param string|null $fragment URL fragment of the anchor
	 * @param Message|string $htmlTitleMessage Title text of anchor
	 */
	public function __construct( $message, Title $title, array $query = array(), $fragment = null, $htmlTitleMessage = null ) {
		$this->title = $title;
		$this->query = $query;
		$this->fragment = $fragment;

		$this->setTitleMessage( $htmlTitleMessage );
		$this->setMessage( $message );
	}

	/**
	 * @return string
	 */
	public function getLinkURL() {
		return $this->resolveTitle()->getLinkURL( $this->query );
	}
	/**
	 * @return string
	 */
	public function getFullURL() {
		return $this->resolveTitle()->getFullURL( $this->query );
	}

	/**
	 * @return string
	 */
	public function getCanonicalURL() {
		return $this->resolveTitle()->getCanonicalURL( $this->query );
	}

	/**
	 * @param string|null $content Optional
	 * @return string HTML
	 */
	public function toHtml( $content = null ) {
		$text = $this->message->text();
		$titleText = $this->getTitleMessage()->text();

		// Should we instead use Linker?
		return Html::element(
			'a',
			array(
				'href' => $this->getLinkURL(),
				'title' => $titleText,
			),
			$content === null ? $text : $content
		);
	}

	public function toArray() {
		return array(
			'url' => $this->getLinkURL(),
			'title' => $this->getTitleMessage()->text(), // Title text
			'text' => $this->message->text(), // Main text of link
		);
	}

	/**
	 * @return Title
	 */
	public function resolveTitle() {
		$title = $this->title;
		if ( $this->fragment !== null ) {
			$title = clone $title;
			$title->setFragment( $this->fragment );
		}

		return $title;
	}

	/**
	 * Canonicalizes and returns a message, or null if null was provided
	 *
	 * @param Message|string $message Message object, or text content, or null
	 * @return Message|null
	 */
	protected function buildMessage( $rawMessage ) {
		if ( $rawMessage instanceof Message || $rawMessage === null ) {
			return $rawMessage;
		} else {
			// wrap non-messages into a message class
			$message = new RawMessage( '$1' );
			$message->plaintextParams( $rawMessage );
			return $message;
		}
	}

	/**
	 * Sets the text of the anchor.  If title message is currently
	 *  null, it will also set that.
	 *
	 * @param Message|string $message Text content of the anchor,
	 *  as Message or text content.
	 */
	public function setMessage( $message ) {
		$this->message = $this->buildMessage( $message );
	}

	/**
	 * Sets the title attribute of the anchor
	 *
	 * @param Message|string $message Text for title attribute of anchor,
	 *  as Message or text content.
	 */
	public function setTitleMessage( $message ) {
		$this->titleMessage = $this->buildMessage( $message );
	}

	/**
	 * Returns the effective title message.  Takes into account defaulting
	 *  to $this->message if there is none.
	 *
	 * @return Message Title message
	 */
	protected function getTitleMessage() {
		if ( $this->titleMessage !== null ) {
			return $this->titleMessage;
		} else {
			return $this->message;
		}
	}
}
