<?php

namespace App\Service;

class EmailParser {

    private $input;
    private $gSuiteEmails = [];
    private $otherEmails = [];

    public function setInput(string $input)
    {
        $this->input = $input;
    }

    public function filterDomains($input = null)
    {
        if ($input == null) {
            $input = $this->input;
        }

        $domains = explode(PHP_EOL, $input);

        if (!empty($domains)) {
            foreach ($domains as $key => $domain) {

                $domain = trim($domain);
                if (\EmailParser::isDomainGSuite($domain)) {
                    $this->gSuiteEmails[] = $domain;
                } else {
                    $this->otherEmails[] = $domain;
                }
            }
        }

        return $this;
    }

    public function isDomainGSuite(string $domain)
    {
        try {
            $records = dns_get_record($domain, DNS_MX);
        } catch (\Exception $e) {
            dump($domain);
            dd($e->getMessage());
        }


        if (!empty($records)) {
            foreach ($records as $record) {
                $target = strtolower($record['target']);
                $position = strpos($target, 'google');

               if ($position !== false) {
                   return true;
               }
            }
        }

        return false;
    }

    public function getOtherEmails()
    {
        return $this->otherEmails;
    }

    public function getGSuiteEmails()
    {
        return $this->gSuiteEmails;
    }
}