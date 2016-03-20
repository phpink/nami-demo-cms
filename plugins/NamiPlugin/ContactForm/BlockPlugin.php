<?php namespace NamiPlugin\ContactForm;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\FormInterface;
use PhpInk\Nami\CoreBundle\Plugin\Block as NamiPluginBlock;
use NamiPlugin\ContactForm\Form\Type\ContactFormType;

/**
 * ContactForm block plugin
 *
 * @package NamiPlugin
 */
class BlockPlugin extends NamiPluginBlock
{
    /**
     * View marker when mail is sent
     * @var bool
     */
    private $mailSent = false;

    /**
     * Plugin main block processing
     * @return NamiPluginBlock
     */
    public function process()
    {
        $session = $this->request->getSession();
        if (!$session) {
            $session = new Session();
            $session->start();
            $this->request->setSession($session);
        }
        $this->output = $this->controller->renderView(
            $this->getParameter('namiplugin.contactform.block_template'),
            array(
                'form' => $this->getForm()->createView(),
                'mailSent' => $this->mailSent
            )
        );
        return $this;
    }

    /**
     * Build the contact form
     * @return \Symfony\Component\Form\Form
     */
    private function getForm()
    {
        $form = $this->controller->createForm(
            new ContactFormType(
                $this->request->getSession(),
                $this->controller->get('translator')
            )
        );

        // Submit the form data
        if ($this->request->isMethod('post')) {
            $form->submit($this->request);

            // If the submitted data is valid
            if ($form->isValid()) {
                $this->sendMail($form);
            }
        }
        return $form;
    }

    /**
     * Send the contact mail when form has been validated
     * @param FormInterface $form
     */
    private function sendMail($form)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($form->get('subject')->getData())
            ->setFrom($form->get('email')->getData())
            ->setTo(
                $this->getParameter('namiplugin.contactform.mail_to')
            )
            ->setBody(
                $this->controller->renderView(
                    $this->getParameter('namiplugin.contactform.mail_template'),
                    array(
                        'host' => $this->getParameter('host'),
                        'ip' => $this->request->getClientIp(),
                        'browser' => $this->request->headers->get('user-agent'),
                        'subject' => $form->get('subject')->getData(),
                        'name' => $form->get('name')->getData(),
                        'email' => $form->get('email')->getData(),
                        'company' => $form->get('company')->getData(),
                        'message' => $form->get('message')->getData()
                    )
                )
            );
        $this->controller->get('mailer')->send($message);
        $this->mailSent = 'Votre message a bien été envoyé. Merci';
     }
}
