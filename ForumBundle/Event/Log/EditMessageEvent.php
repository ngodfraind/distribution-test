<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Claroline\ForumBundle\Event\Log;

use Claroline\CoreBundle\Event\Log\AbstractLogResourceEvent;
use Claroline\ForumBundle\Entity\Message;

class EditMessageEvent extends AbstractLogResourceEvent
{
    const ACTION = 'resource-claroline_forum-edit_message';

    /**
     * @param \Claroline\ForumBundle\Entity\Message $message
     * @param string $oldContent
     * @param string $newContent
     */
    public function __construct(Message $message, $oldContent, $newContent)
    {
        $details = array(
            'message' => array(
                'id' => $message->getId(),
                'old_content' => $oldContent,
                'new_content' => $newContent
            ),
            'subject' => array(
                'id' => $message->getSubject()->getId()
            ),
            'category' => array(
                'id' => $message->getSubject()->getCategory()->getId()
            ),
            'forum' => array(
                'id' => $message->getSubject()->getCategory()->getForum()->getId()
            )
        );

        parent::__construct($message->getSubject()->getCategory()->getForum()->getResourceNode(), $details);
    }

    /**
     * @return array
     */
    public static function getRestriction()
    {
        return array(self::DISPLAYED_WORKSPACE, self::DISPLAYED_ADMIN);
    }
}