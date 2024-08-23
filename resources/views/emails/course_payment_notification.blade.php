<div style="max-width:800px;margin:0 auto;border:0.336601px solid rgba(19,18,18,0.1);border-radius:8px" class="m_-8636049235336462165top-section">
    <table>
      <tbody style="font-size:10px;color:#1a1a1a;font-weight:500">
        <tr class="m_-8636049235336462165logo-black" style="float:left;width:100%;padding:40px 44px">
          <td>
            <img src="https://nigeriatrainingportal.com/assets/images/ntp-logo.png" alt="Grey" style="width:120px" class="CToWUd" data-bit="iit">
          </td>
        </tr>
      </tbody>
    </table>

    <table style="width:100%">
      <tbody>
        <tr>
          <td>
            <p style="padding-top:40px;text-align:left;font-weight:700;padding:0px 44px;font-size:1rem;font-weight:400;margin-bottom:16px" class="m_-8636049235336462165welcome-message">
              Hello {{$user->firstname}},
            </p>
          </td>
        </tr>
        <tr style="padding-top:0">
          <td>
            <h3 class="m_-8636049235336462165title" style="padding: 0px 44px;">Your transaction was successful <img data-emoji="🤑" class="an1" alt="🤑" aria-label="🤑" draggable="false" src="https://fonts.gstatic.com/s/e/notoemoji/15.0/1f911/72.png" loading="lazy">
                                
                              </h3>
          </td>
        </tr>
        <tr>
          <td>
            <p style="font-weight:400;line-height:30px;font-size:1rem;padding:0 44px" class="m_-8636049235336462165welcome-message">
              The details are shown below:
            </p>
          </td>
        </tr>
        <tr>
          <td style="overflow:hidden;padding:10px 48px" class="m_-8636049235336462165transaction">
            <div style="width:100%;max-width:190%;margin:auto;margin-bottom:2rem;padding:1.5rem 1.5rem;padding-bottom:0.5rem;border-radius:8px;background:#f0f6fe">
              <table style="width:100%;color:#131212;font-size:14px;border-spacing:0;border-collapse:collapse" cellspacing="0">
                <tbody>
                  <tr>
                    <td style="font-weight:500;color:#131212;border-bottom:1px solid #e1e1e1;padding-bottom:1.5rem">
                      Transaction Type:
                    </td>
                    <td style="font-weight:300;color:#131212;border-bottom:1px solid #e1e1e1;padding-bottom:1.5rem;text-align:right">
                                                      debit
                    </td>
                  </tr>
                  <tr>
                    <td style="font-weight:500;padding:1.5rem 0;color:#131212;border-bottom:1px solid #e1e1e1">
                      Merchant:
                    </td>
                    <td style="font-weight:300;color:#131212;border-bottom:1px solid #e1e1e1;text-align:right">
                                                          {{$transactionDetails['merchant']}}
                    </td>
                  </tr>
                  <tr>
                    <td style="font-weight:500;padding:1.5rem 0;color:#131212;border-bottom:1px solid #e1e1e1">
                      Amount Debited:
                    </td>
                    <td style="font-weight:300;color:#131212;padding-left:0;border-bottom:1px solid #e1e1e1;text-align:right">
                                              {{$transactionDetails['amount']}}
                    </td>
                  </tr>
                      <tr>
                    <td style="font-weight:500;padding:1.5rem 0;color:#131212;border-bottom:1px solid #e1e1e1">
                      Description:
                    </td>
                    <td style="font-weight:300;color:#131212;padding-left:0;border-bottom:1px solid #e1e1e1;text-align:right">
                                                {{$transactionDetails['description']}}
                    </td>
                  </tr>
                  

                  <tr>
                    <td style="font-weight:500;padding:1.5rem 0;color:#131212;border-bottom:1px solid #e1e1e1">
                      Reference:
                    </td>
                    <td style="font-weight:300;color:#131212;padding-left:0;border-bottom:1px solid #e1e1e1;text-align:right">
                        {{$transactionDetails['reference']}}
                    </td>
                  </tr>
                  <tr>
                    <td style="font-weight:500;padding:1.5rem 0;color:#131212;padding:1.5rem 0">
                      Date &amp; Time:
                    </td>
                    <td style="font-weight:300;color:#131212;padding-left:0;text-align:right">
                        {{$transactionDetails['date']}}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding:0 44px 40px 44px;font-size:1rem" class="m_-8636049235336462165welcome-message">
            <p style="font-weight:300;line-height:30px;font-size:1rem">
              If you didn't initiate this transaction, please contact our support team
              immediately via in-app or email <span class="m_-8636049235336462165support"> <a href="mailto:support@ntp.co" target="_blank">support@ntp.co</a> </span>
            </p>
          </td>
        </tr>
      </tbody>
    </table><div class="yj6qo ajU"><div id=":mn" class="ajR" role="button" tabindex="0" data-tooltip="Show trimmed content" aria-label="Show trimmed content" aria-expanded="false"><img class="ajT" src="//ssl.gstatic.com/ui/v1/icons/mail/images/cleardot.gif"></div></div><div class="adL">
  </div></div>