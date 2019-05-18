<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailCheckerController extends Controller
{
    public function processDomains(Request $request)
    {
        $domains = $request->input('domains');

        \EmailParser::setInput($domains);
        $emailParser = \EmailParser::filterDomains();

        $result = [
          'gSuiteEmails' => \EmailParser::getGSuiteEmails(),
          'otherEmails' => \EmailParser::getOtherEmails(),
        ];

        return redirect()->back()->with($result);
    }
}
