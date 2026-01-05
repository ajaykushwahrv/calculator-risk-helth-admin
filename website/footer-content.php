<div class="disclaimer-sec ">
                <div class="content-b ">

                    <div class="disclaimer-sec text-center">
                        <div class="content-b ">
                            <p class="">AMFI Registered Mutual Fund Distributor |
                                <?php $arndata = rvFetchAllData($con, 'arn'); foreach($arndata as $arndat){?>ARN :
                                <b><?= $arndat['arn_no'];?></b> <?php  } ?> | Date of Registration: <b>24-Jul-2013</b>
                                | Current
                                Validity: <b>24-Jul-2013</b> TO <b>16-Apr-2031</b>
                            </p>
                            <p class="pt-2 pb-2">
                                <a href="<?= $userinfo['base_url'];?>/sabi/privacy-policy.php">Privacy Policy</a> |
                                <a href="<?= $userinfo['base_url'];?>/sabi/commission-disclosures.php">Commission
                                    Disclosures</a> |
                                <a href="<?= $userinfo['base_url'];?>/sabi/risk-factors.php">Risk Factors </a> |
                                <a href="<?= $userinfo['base_url'];?>/sabi/terms-conditions.php">Terms &amp; Conditions </a>
                                |
                                <a href="https://www.sebi.gov.in/filings/mutual-funds.html" target="_">SID/SAI/KIM </a>
                                |
                                <a href="<?= $userinfo['base_url'];?>/assets/images/AMFI_Code-of-Conduct.pdf"
                                    target="_">Code of
                                    Conduct </a> |
                                <a href="<?= $userinfo['base_url'];?>/sabi/investor-grievance-redressal.php"
                                    target="_">Investor
                                    Grievance Redressal </a> |
                                <a href="<?= $userinfo['base_url'];?>/sabi/important-links.php">Important links </a> |
                                <a href="https://www.sebi.gov.in/sebiweb/home/HomeAction.do?doListingAll=yes&amp;search=Mutual+Funds"
                                    target="_">SEBI Circulars </a>
                            </p>

                            <p><b><?= $userinfo['name'];?></b> is an AMFI Registered Mutual Fund Distributor.</p>
                            <p>Disclaimer: Mutual fund investments are subject to market risks. Please read the scheme
                                information
                                and other related documents carefully before investing. Past performance is not
                                indicative of
                                future
                                returns. Please consider your specific
                                investment requirements before choosing a fund, or designing a portfolio that suits
                                your needs.
                            </p>
                            <p><b><?= $userinfo['name'];?></b> makes no warranties or representations, express or
                                implied, on
                                products offered through the platform of <b><?= $userinfo['name'];?></b>. It accepts no
                                liability for any damages or losses, however, caused,
                                in connection with the use of, or on the reliance of its product or related services.
                                Terms and
                                conditions of the website are applicable. Investments in Securities markets are subject
                                to
                                market
                                risks, read all the related documents carefully
                                before investing.</p>
                            <div class="footer-content pb-4">
                                <div class="footer-list">
                                    <div class="image"><img src="/images/amfi.jpg">
                                    </div>
                                </div>
                                <div class="footer-list">
                                    <div class="image"><img
                                            src="/images/mutualfund.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>