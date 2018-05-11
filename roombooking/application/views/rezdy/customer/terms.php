<script type="text/javascript">
    $(document).ready(function () {

        //how much items per page to show
        var show_per_page = 6;
        //getting the amount of elements inside content div
        var number_of_items = $('#content').children().size();
        //calculate the number of pages we are going to have
        var number_of_pages = Math.ceil(number_of_items / show_per_page);

        //set the value of our hidden input fields
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);

        //now when we got all we need for the navigation let's make it '

        /* 
         what are we going to have in the navigation?
         - link to previous page
         - links to specific pages
         - link to next page
         */
        var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
        var current_link = 0;
        while (number_of_pages > current_link) {
            navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link + ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
            current_link++;
        }
        navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';

        $('#page_navigation').html(navigation_html);

        //add active_page class to the first page link
        $('#page_navigation .page_link:first').addClass('active_page');

        //hide all the elements inside content div
        $('#content').children().css('display', 'none');

        //and show the first n (show_per_page) elements
        $('#content').children().slice(0, show_per_page).css('display', 'block');

    });

    function previous() {

        new_page = parseInt($('#current_page').val()) - 1;
        //if there is an item before the current active link run the function
        if ($('.active_page').prev('.page_link').length == true) {
            go_to_page(new_page);
        }

    }

    function next() {
        new_page = parseInt($('#current_page').val()) + 1;
        //if there is an item after the current active link run the function
        if ($('.active_page').next('.page_link').length == true) {
            go_to_page(new_page);
        }

    }
    function go_to_page(page_num) {
        //get the number of items shown per page
        var show_per_page = parseInt($('#show_per_page').val());

        //get the element number where to start the slice from
        start_from = page_num * show_per_page;

        //get the element number where to end the slice
        end_on = start_from + show_per_page;

        //hide all children elements of content div, get specific items and show them
        $('#content').children().css('display', 'none').slice(start_from, end_on).css('display', 'inline-block');

        /*get the page link that has longdesc attribute of the current page and add active_page class to it
         and remove that class from previously active page link*/
        $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass('active_page');

        //update the current page input field
        $('#current_page').val(page_num);
    }

</script>
</script>
<div class="home-tour">
    <div class="container"> 	
        <article class="post-3505 page type-page status-publish entry" itemscope="" itemtype="https://schema.org/CreativeWork"><header class="entry-header"><h1 class="entry-title" itemprop="headline">Terms and Conditions</h1>
        </header><div class="entry-content" itemprop="text"><p>Surf You To The Moon Terms and Conditions</p>
        <div class="row">
            <p style="text-align: right;"><a onclick="window.history.back();" style="cursor:pointer;">Click here to Return ...</a></p>
        </div>
        <p>Table of Contents:<br>
        <a href="#1">Introduction</a><br>
        <a href="#2">Definition</a><br>
        <a href="#3">Acceptance of Terms</a><br>
        <a href="#4">Purpose</a><br>
        <a href="#5">Modification</a><br>
        <a href="#6">Eligibility</a><br>
        <a href="#7">Responsibility</a><br>
        <a href="#8">Member Content</a><br>
        <a href="#9">Account Registration</a><br>
        <a href="#10">Endorsement</a><br>
        <a href="#11">Our Appointment as Social Connection Payment Agent</a><br>
        <a href="#12">Foreign Currency</a><br>
        <a href="#13">Governing Law</a><br>
        <a href="#14">Content of the Website</a><br>
        <a href="#15">Links</a><br>
        <a href="#16">Termination and Surf You To The Moon Account Cancellation</a><br>
        <a href="#17">Disclaimers</a><br>
        <a href="#18">Limitation of Liability</a><br>
        <a href="#19">Acceptance of Risk</a><br>
        <a href="#20">Indemnification and Release</a><br>
        <a href="#21">Reporting Misconduct</a><br>
        <a href="#22">Severability</a><br>
        <a href="#23">Enquiry</a><br>
        <a href="#24">Cancellation Policy</a><br>
        <a href="#25">Special Provisions Applicable for Members Outside The United States</a></p>
        <p>Last Updated: August 19, 2016</p>
        <p>TERMS AND CONDITIONS AGREEMENT</p>
        <p><a name="1"></a>1. INTRODUCTION<br>
        This Agreement sets forth the terms and conditions between:<br>
        1. Surf You To The Moon,<br>
        2. Users,<br>
        3. Tour Guides.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="2"></a>2. DEFINITION<br>
        Surf You To The Moon: Surf You To The Moon, www.surfyoutothemoon.com (hereafter referred to as “website”, “we”, “us”, or “our”) is the provider of an online platform to establish social connection between the Users and Tour Guides.<br>
        Users: Users (hereafter referred to as “you”, “your”) are travelers who are willing to establish social relationship with Tour Guides.<br>
        Tour Guides: Tour Guides (hereafter referred to as “Host”) are people with experience and knowledge of a travel destination(s) which the user(s) are about to visit or are already in.<br>
        Terms and Conditions Agreement: Terms and Conditions Agreement hereafter referred to as “terms”, “terms and conditions”.<br>
        Activities: Services (hereafter referred to as “activities”, “activity”) under this Terms &amp; Conditions Agreement means:<br>
        ● Establishing social connection between the Users and the Hosts,<br>
        ● Sharing of experience and knowledge of the Host with the Users,<br>
        ● Serving as the limited agent of each Host for the purpose of accepting payments from Users on behalf of the Host.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p>Collective Content: Collective Content means:<br>
        1) Tour Guide’s Content,<br>
        2) User’s Content and<br>
        3) Surf You To The Moon’s Content.<br>
        “Content” means text, graphics, images, music, audio, video, information or other materials.<br>
        Member: Member here means Host &amp; User who have registered in our website or a user who have requested for a activity.<br>
        Parties: Surf You To The Moon, Users and Hosts are together referred as parties.<br>
        Party: Surf You To The Moon, Users and Hosts individually are referred as party.</p>
        <p>Now, this Terms and Conditions Agreement read as under.</p>
        <p><a name="3"></a>3. ACCEPTANCE OF TERMS<br>
        YOU ACKNOWLEDGE AND AGREE THAT, BY ACCESSING OR USING THE ACTIVITIES OR BY DOWNLOADING OR POSTING ANY CONTENT FROM OR ON THE WEBSITE, VIA THE APPLICATION OR OTHERWISE THROUGH THE ACTIVITIES YOU ARE INDICATING THAT YOU HAVE READ, AND THAT YOU UNDERSTAND AND AGREE TO BE BOUND BY THESE TERMS &amp; CONDITIONS, WHETHER OR NOT YOU HAVE REGISTERED WITH THE WEBSITE. IF YOU DO NOT AGREE TO THESE TERMS, THEN YOU HAVE NO RIGHT TO ACCESS OR USE THE WEBSITE, OR COLLECTIVE CONTENT. IF YOU ACCEPT OR AGREE TO THESE TERMS &amp; CONDITIONS ON BEHALF OF A COMPANY OR OTHER LEGAL ENTITY, YOU REPRESENT AND WARRANT THAT YOU HAVE THE AUTHORITY TO BIND THAT COMPANY OR OTHER LEGAL ENTITY TO THESE TERMS AND, IN SUCH EVENT, ”YOU” AND “YOUR” WILL REFER AND APPLY TO THAT COMPANY OR OTHER LEGAL ENTITY.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="4"></a>4. PURPOSE<br>
        The purpose of this platform is to establish a social connection between the Users and the Hosts. The Hosts through their collective content will share their experience and knowledge about the travel destination(s) or activity therein which they have visited before or are currently living in. The Users can access this information through our platform and establish a social connection with the Host to fully explore their travel destination(s) or conduct the activity in the travel destination(s) which they are about to visit or are already in. This platform has been set for social purpose and is in no way inclined towards being commercial. The fee which the Users are paying is mere a charge to establish social connection between the Users and the Hosts. These Terms govern your access to and use of the website and all Collective Content and constitute a binding legal agreement between You and Surf You To The Moon. YOU UNDERSTAND AND AGREE THAT SURF YOU TO THE MOON IS NOT A PARTY TO ANY AGREEMENTS ENTERED INTO BETWEEN USER AND HOST.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="5"></a>5. MODIFICATION<br>
        We reserve the right, at its sole discretion, to modify the Activities at any time and without prior notice. If we modify these Terms, we will post the modification on the Site or via the Activities or provide you with notice of the modification. We will also update the “Last Updated Date” at the top of these Terms. Any changes will become effective immediately upon your acceptance of the modified Terms. If the modified Terms are not acceptable to you, your only recourse is to cease using the Activities.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="6"></a>6. ELIGIBILITY<br>
        The Activities are preferred for persons who are 18 years or older. People below 18 years of age may avail the activities if they along with their guardian sign a written application allowing their child to avail our activities.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="7"></a>7. RESPONSIBILITY<br>
        As stated above, Surf You To The Moon makes available a platform with related technology for Users and Hosts to meet online, write reviews, search, compare, enter contests and arrange for bookings of Users. Surf You To The Moon is not an operator of tours, activities or other Group Tours, nor is it a provider of group tours or activities and Surf You To The Moon does not own, sell, resell, furnish, provide, manage and/or control any transportation, tour or travel services. Surf You To The Moon responsibilities are limited to: (i) facilitating the availability of the Activities and (ii) serving as the limited agent of each Host for the purpose of accepting payments from Users on behalf of the Host. SURF YOU TO THE MOON CANNOT AND DOES NOT CONTROL THE HOST’S CONTENT NOR DOES IT CONTROL THE USER’S CONTENT. ACCORDINGLY, THE GENUINENESS OF THESE CONTENTS FOR THE PURPOSE OF USE WILL BE AT USER’S OWN RISK.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="8"></a>8. MEMBER CONTENT<br>
        When Members contribute the Content to our website, we presume that content:<br>
        1) Do not contain any type of confidential or proprietary information;</p>
        <p>2) Shall not be liable or under any obligation to ensure or maintain confidentiality, expressed or implied, related to any Contributions;</p>
        <p>3) The contributor’s contributions shall automatically become the sole property of ; and</p>
        <p>4) Is under no obligation to either compensate or provide any form of reimbursement in any manner or nature.</p>
        <p>We may, in our sole discretion, permit Members to post, upload, publish, submit or transmit Member Content. By making available any Member Content on or through the Activities, you hereby grant to us a worldwide, irrevocable, perpetual, non-exclusive, transferable, royalty-free license, with the right to sublicense, to use, view, copy, adapt, modify, distribute, license, sell, transfer, publicly display, publicly perform, transmit, stream, broadcast, access, view, and otherwise exploit such Member Content on, through, or by means of the Activities. We may use the member’s content for the purpose of our advertisement.<br>
        We do not claim any ownership rights in any such Member Content and nothing in these Terms will be deemed to restrict any rights that you may have to use and exploit any such Member Content. You must not store illegal content on the website and we will monitor our site regularly for such illegal content.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="9"></a>9. ACCOUNT REGISTRATION<br>
        For Host:<br>
        Host that wish to share their knowledge and experience and wish to socially connect with the users in exchange of fees need to first submit their application via the Host signup form. We then review all sign up requests and assess the compatibility of the Host’s content. This review process can take up to 2 weeks as the product, company, market fit, bonding, safety and global reputation of the company is assessed. Upon reviewing the sign up request our team inform the Hosts whether or not they are eligible to act as Host in our platform. Once the Host application is confirmed, we will guide and assist the Host through the next sign up steps, which includes uploading the Host’s content wherever possible. We reserve the right to decline the application at this stage, or any other, stage. Before Host can start establishing social connection with user, Host must agree to our Terms and Conditions Agreement.<br>
        For User:<br>
        In order to access certain features of the Activities and establish a social connection with Host, you must register to create an account (“Surf You To The Moon Account”) and become a Member. You may register to join the Activities directly via the website or by logging into your account with certain third party social networking sites (“SNS”) (including, but not limited to, Facebook). As part of the functionality of the Activities, you may be able to link your Surf You To The Moon Account with Third Party Accounts, by either:<br>
        a) Providing your Third Party Account login information to us through the Activities; or</p>
        <p>b) Allowing us to access your Third Party Account, as is permitted under the applicable terms and conditions that govern your use of each Third Party Account. You represent that you are entitled to disclose your Third Party Account login information to us and/or grant us access to your Third Party Account (including, but not limited to, for use for the purposes described herein), without breach by you of any of the terms and conditions that govern your use of the applicable Third Party Account and without obligating us to pay any fees or making us subject to any usage limitations imposed by such third party activity providers. PLEASE NOTE THAT YOUR RELATIONSHIP WITH THE THIRD PARTY SERVICE PROVIDERS ASSOCIATED WITH YOUR THIRD PARTY ACCOUNTS IS GOVERNED SOLELY BY YOUR AGREEMENT(S) WITH SUCH THIRD PARTY SERVICE PROVIDERS.</p>
        <p>We make no effort to review any SNS Content for any purpose, including but not limited to, for accuracy, legality or non-infringement and we are not responsible for any SNS Content. We will create your Surf You To The Moon Account and your Surf You To The Moon Account profile page for your use of the Activities based upon the personal information you provide to us or that we obtain via an SNS as described above. You may not have more than one (1) active Surf You To The Moon Account. You agree to provide accurate, current and complete information during the registration process and to update such information to keep it accurate, current and complete. We reserve the right to suspend or terminate your Surf You To The Moon Account and your access to the Activities if you create more than one (1) Surf You To The Moon Account or if any information provided during the registration process or thereafter proves to be inaccurate, not current or incomplete. You are responsible for safeguarding your password. You agree that you will not disclose your password to any third party and that you will take sole responsibility for any activities or actions under your Surf You To The Moon Account, whether or not you have authorized such activities or actions. You will immediately notify us of any unauthorized use of your Surf You To The Moon Account. In case if a user is registering for our activities, we assume that such user has created their Surf You To The Account and that by registering to any of our activities the user is agreeing with this Terms and Condition Agreements. We are NOT responsible for lost data, time, income or any other resource due to faulty backups or non-existent backups. Please always backup your own data for Redundancy.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="10"></a>10. ENDORSEMENT<br>
        We do not endorse any member (“User / Host”). In addition, although these Terms require Members to provide accurate information, we do not attempt to confirm, and do not confirm, any Member’s purported identity. You are responsible for determining the identity and suitability of others who you contact via the Activities. We will not be responsible for any damage or harm resulting from your social interactions with other Members. By using the Activities, you agree that any legal remedy or liability that you seek to obtain for actions or omissions of other Members or other third parties will be limited to a claim against the particular Members or other third parties who caused you harm and you agree not to attempt to impose liability on, or seek any legal remedy from Surf You To The Moon with respect to such actions or omissions. Accordingly, we encourage you to communicate directly with other Members via the Activities regarding any bookings by you. This limitation shall not apply to any claim by an Host against us regarding the remittance of payments received from a User by us on behalf of a Host, which instead shall be subject to the limitations described in the section below entitled “Limitation of Liability”.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="11"></a>11. OUR APPOINTMENT AS SOCIAL CONNECTION PAYMENT AGENT<br>
        Members hereby appoints us as the member’s limited agent solely for the purpose of collecting payments made by User on behalf of the Host. Members agrees that payment made by a User to us shall be considered the same as a payment made directly to the Host and the Host will make the activities available to User in the agreed upon manner as if the Host has received the Part Payment. In accepting appointment as the limited authorized agent of the Host, we assume no liability for any acts or omissions of the Host. Members acknowledge and agree that we reserve the right, in its sole discretion, to introduce and collect other fees from you in accordance with the Modification Section of these Terms. Please note that we will provide notice of new fees via the Activities, prior to implementing such new features.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="12"></a>12. FOREIGN CURRENCY<br>
        As part of the Activities, we may provide a feature through which users may view prices for various social connects in foreign currencies. You understand and agree that these views of prices are for informational purposes only and may not be the official local price for the activities which the Host will be performing. If your social connect booking is confirmed by a Host, you will be notified of the currency in which you will be charged together with the corresponding amount of the Payment. The currency in which you will be charged may be determined by us based on the payment method you select and the location of your travel destination(s). If the currency in which you will be charged is different from the currency chosen by the Host to receive payment, we will be responsible for the required currency conversion processing, including the costs thereof, which will be calculated based on the most current applicable foreign exchange rate from a reliable source.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="13"></a>13. GOVERNING LAW<br>
        This Terms &amp; Condition Agreement shall be subject to and governed by the laws of the State of California without regards to conflict of law principles, and irrespective of the fact that a party is or may become a resident of a different state. The Members agrees that in any action brought by us against Members arising from this Terms &amp; Conditions, Members agrees to:<br>
        (a) submit to the personal jurisdiction of the Courts in the State of California,<br>
        (b) accept service of process by mail, and<br>
        (c) waive all defenses premised upon personal or subject matter jurisdiction.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="14"></a>14. CONTENT OF THE WEBSITE<br>
        Subject to your compliance with the terms and conditions of these Terms, we grant you a limited, non-exclusive, non-transferable license to:<br>
        1) Access and view any of our Content solely for your personal and noncommercial purposes and</p>
        <p>2) Access and view any Member Content to which you are permitted access, solely for your personal and noncommercial purposes.</p>
        <p>You have no right to sublicense the license rights granted in this section. You will not use, copy, adapt, modify, prepare derivative works based upon, distribute, license, sell, transfer, publicly display, publicly perform, transmit, broadcast or otherwise exploit the Activities or Collective Content, except as expressly permitted in these Terms. No licenses or rights are granted to you by implication or otherwise under any intellectual property rights owned or controlled by us or its licensors, except for the licenses and rights expressly granted in these Terms.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="15"></a>15. LINKS<br>
        The activities may contain links to third-party websites or resources. You acknowledge and agree that we are not responsible or liable for:<br>
        1) the availability or accuracy of such websites or resources; or</p>
        <p>2) the content, products, or services on or available from such websites or resources.</p>
        <p>Links to such websites or resources do not imply any endorsement by us of such websites or resources or the content, products, or activities available from such websites or resources. You acknowledge sole responsibility for and assume all risk arising from your use of any such websites or resources or the Content, products or activities on or available from such websites or resources.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="16"></a>16. TERMINATION AND SURF YOU TO THE MOON ACCOUNT CANCELLATION<br>
        We may, in our discretion and without liability to you, with or without cause, with or without prior notice and at any time:<br>
        a) Terminate your access to the Services, and</p>
        <p>b) Deactivate or cancel your Surf You To The Moon Account.</p>
        <p>Upon termination we will promptly pay you any amounts we reasonably determine we owe you in our discretion for social connect, which we are legally obligated to pay you. In the event we terminate these Terms, or your access to the Activities or deactivates or cancels your Surf You To The Moon Account you will remain liable for all amounts due hereunder. You may cancel your Surf You To The Moon Account at any time. Please note that if your Surf You To The Moon Account is cancelled, we do not have an obligation to delete or return to you any Content you have posted to the Activities, including, but not limited to, any reviews or Feedback. Hosts agree that should they cease their Surf You To The Moon Account, that the Tour Review content captured using Surf You To The Moon will still be available for use.<br>
        In case of violation of our terms and condition by Users, we don’t only reserve the right to cancel their account but also to cease their available credits, if any in their account.<br>
        In case of violation of our terms and condition by Host, we don’t only reserve the right to cancel their account but also to cancel any payments, including future payments, which they owe to us. Upon cancellation of Host account on account of violation of our terms and condition, host shall return back to us – any equipment which we have supplied to them, intellectual property right, physical property privileges or anything, whether in physical form or not, which have been supplied by us to the member for the purpose of activity use.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="17"></a>17. DISCLAIMERS<br>
        A. BY CHOOSING OUR ACTIVITY YOU ACKNOWLEDGE AND AGREE THAT WE DO NOT HAVE AN OBLIGATION TO CONDUCT BACKGROUND CHECKS ON ANY MEMBER, INCLUDING, BUT NOT LIMITED TO, USERS AND HOST, BUT MAY CONDUCT SUCH BACKGROUND CHECKS IN ITS SOLE DISCRETION. THE ACTIVITIES AND COLLECTIVE CONTENT ARE PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED. YOU CHOOSE OUR ACTIVITY AT YOUR SOLE RISK.</p>
        <p>B. WE MAKES NO WARRANTY THAT THE ACTIVITIES OR COLLECTIVE CONTENT, WILL MEET YOUR REQUIREMENTS OR BE AVAILABLE ON AN UNINTERRUPTED, SECURE, OR ERROR-FREE BASIS. WE MAKES NO WARRANTY REGARDING THE QUALITY OF ANY ACTIVITIES OR COLLECTIVE CONTENT OR THE ACCURACY, TIMELINESS, TRUTHFULNESS, COMPLETENESS OR RELIABILITY OF ANY COLLECTIVE CONTENT OBTAINED THROUGH THE ACTIVITIES.</p>
        <p>C. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED FROM US OR THROUGH THE WEBSITE, ACTIVITIES OR COLLECTIVE CONTENT, WILL CREATE ANY WARRANTY NOT EXPRESSLY MADE HEREIN.</p>
        <p>D. YOU ARE SOLELY RESPONSIBLE FOR ALL OF YOUR SOCIAL COMMUNICATIONS AND INTERACTIONS WITH OTHER USERS OF THE ACTIVITIES AND WITH OTHER PERSONS WITH WHOM YOU SOCIALLY COMMUNICATE OR INTERACT AS A RESULT OF YOUR USE OF THE ACTIVITIES, INCLUDING, BUT NOT LIMITED TO, ANY HOST OR USER.</p>
        <p>E. YOU AGREE TO TAKE REASONABLE PRECAUTIONS IN ALL COMMUNICATIONS AND INTERACTIONS WITH OTHER USERS OF THE ACTIVITIES AND WITH OTHER PERSONS WITH WHOM YOU COMMUNICATE OR INTERACT AS A RESULT OF YOUR USE OF THE ACTIVITIES, INCLUDING, BUT NOT LIMITED TO, USERS AND HOSTS, PARTICULARLY IF YOU DECIDE TO MEET OFFLINE OR IN PERSON REGARDLESS OF WHETHER SUCH MEETINGS ARE ORGANIZED BY US OR NOT. NOTWITHSTANDING OUR APPOINTMENT AS THE LIMITED AGENT OF THE HOSTS FOR THE PURPOSE OF ACCEPTING PAYMENTS FROM USERS ON BEHALF OF THE HOSTS, WE EXPLICITLY DISCLAIMS ALL LIABILITY FOR ANY ACT OR OMISSION OF ANY USERS OR OTHER THIRD PARTY.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="18"></a>18. LIMITATION OF LIABILITY<br>
        A. YOU ACKNOWLEDGE AND AGREE THAT, TO THE MAXIMUM EXTENT PERMITTED BY LAW, THE ENTIRE RISK ARISING OUT OF YOUR ACCESS TO AND USE OF THE ACTIVITIES AND COLLECTIVE CONTENT, VIA THE ACTIVITIES, AND ANY CONTACT YOU HAVE WITH OTHER USERS WHETHER IN PERSON OR ONLINE REMAINS WITH YOU.</p>
        <p>B. NEITHER WE NOR ANY OTHER PARTY INVOLVED IN CREATING, PRODUCING, OR DELIVERING THE ACTIVITIES OR THE COLLECTIVE CONTENT WILL BE LIABLE FOR ANY INCIDENTAL, SPECIAL, EXEMPLARY OR CONSEQUENTIAL DAMAGES, INCLUDING LOST PROFITS, LOSS OF DATA OR LOSS OF GOODWILL, ACTIVITY INTERRUPTION, COMPUTER DAMAGE OR SYSTEM FAILURE OR THE COST OF SUBSTITUTE PRODUCTS OR ACTIVITIES, OR FOR ANY DAMAGES FOR PERSONAL OR BODILY INJURY OR EMOTIONAL DISTRESS ARISING OUT OF OR IN CONNECTION WITH THESE TERMS, FROM THE USE OF OR INABILITY TO USE THE ACTIVITIES OR COLLECTIVE CONTENT, FROM ANY COMMUNICATIONS, INTERACTIONS OR MEETINGS WITH OTHER USERS OF THE ACTIVITIES OR OTHER PERSONS WITH WHOM YOU COMMUNICATE OR INTERACT AS A RESULT OF YOUR USE OF THE ACTIVITIES VIA THE ACTIVITIES, WHETHER BASED ON WARRANTY, CONTRACT, TORT (INCLUDING NEGLIGENCE), PRODUCT LIABILITY OR ANY OTHER LEGAL THEORY, AND WHETHER OR NOT SURF YOU TO THE MOON HAS BEEN INFORMED OF THE POSSIBILITY OF SUCH DAMAGE, EVEN IF A LIMITED REMEDY SET FORTH HEREIN IS FOUND TO HAVE FAILED OF ITS ESSENTIAL PURPOSE.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="19"></a>19. ACCEPTANCE OF RISK<br>
        Members acknowledge that all travel involves an element of risk and that some activities offered on the website may be adventurous in nature and may involve a significant amount of personal risk. Members hereby assume all such risk and Members, your estate, your family, heirs and assigns hereby release us from all claims and causes of action whatsoever arising from any injury, death or other damages, both pecuniary and non-pecuniary, to Members that may occur as a result of your participation in the activities offered on the website or as a result of the negligence of any party, including the Host or any employee, officer, agent, contractor or assign of us, whether such negligence is passive or active.<br>
        Members are strongly encouraged to obtain suitable medical insurance prior to availing any activities.<br>
        We urge you to exercise caution if you purchase any goods during your tour. Neither do we nor the Host make any claims about the quality, source or other provenance of any goods which may be available for purchase.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="20"></a>20. INDEMNIFICATION AND RELEASE<br>
        You agree to release, defend, indemnify, and hold Surf You To The Moon and its affiliates and subsidiaries, and their officers, directors, employees and agents, harmless from and against any claims, liabilities, damages, losses, and expenses, including, without limitation, reasonable legal and accounting fees, arising out of or in any way connected with<br>
        a) Your access to or use of the website, Activities, or Collective Content or your violation of these Terms;</p>
        <p>b) Your Member Content; and</p>
        <p>c) Your:</p>
        <p>i. Interaction with any Member,</p>
        <p>ii.Use, quality of activity, including, but not limited to any injuries, losses, or damages (compensatory, direct, incidental, consequential or otherwise) of any kind arising in connection with or as a result of participating in using our activities.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="21"></a>21. REPORTING MISCONDUCT<br>
        If you establish social connection with a Host who you feel is acting or has acted inappropriately, including but not limited to, anyone who<br>
        1) Engages in offensive, violent or sexually inappropriate behavior,</p>
        <p>2) You suspect of stealing from you, or</p>
        <p>3) Engages in any other disturbing conduct, you should immediately report such person to the appropriate authorities and then to us by contacting us with your police station and report number at 1-800-916-2739; provided that your report will not obligate us to take any action beyond that required by law (if any) or cause us to incur any liability to you.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="22"></a>22. SEVERABILITY<br>
        In the event that any one or more of the phrases, sentences, clauses, paragraphs, or sections contained in this terms shall be declared invalid or unenforceable by a valid judgment or decree of a court of competent jurisdiction, such invalidity or unenforceability shall not affect any of the remaining phrases, sentences, clauses, paragraphs, or sections of this contract which are hereby declared as severable and shall be interpreted to carry out the intent of the parties hereunder unless the invalid provision is so material that its invalidity deprives either party of the basic benefit of their bargain or renders this terms meaningless.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="23"></a>23. ENQUIRY<br>
        If you have any enquiry for these terms, please feel free to contact us at reservations@surfyoutothe moon.com</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="24"></a>24. CANCELLATION POLICY<br>
        A. Cancellation policy in case of the User who has paid for trip protection is as under:</p>
        <p>1. 100% of activity fees shall be refunded back to the user who cancels their activity anytime before the scheduled date and time of activity.<br>
        2. In case if the User wants to re-schedule the activity anytime before the scheduled date and time of activity, 100% of activity fees which the user has already paid shall be credited with the re-scheduled activity fees.<br>
        3. 100% of activity fees shall be credited to the User’s Surf You To The Moon account to facilitate their future use of our activity who cancels their activity anytime before the scheduled date and time of activity.</p>
        <p>B. Cancellation policy in case of the User who has not paid for trip protection as follow:<br>
        1. 100% of fees paid for add-ons shall be refunded back to the user who cancels their activity anytime before the scheduled date and time of activity.<br>
        2. 50 % of booking fees shall be refunded back to the user who cancels their activity 48 hours before the scheduled date and time of activity. Booking fees shall fail to be refunded in case if the User opts for cancellation within 48 hours of their scheduled activity date and time.<br>
        3. 100% of activity fees shall be credited for the re-scheduled activity fees to the user who cancels their activity anytime before the scheduled date and time of activity.<br>
        4. 100% of activity fees shall be credited to the User’s Surf You To The Moon account to facilitate their future use of our activity who cancels their activity anytime before the scheduled date and time of activity.<br>
        No refund/credit shall be entertained if the User opts for cancellation after the scheduled date and time of activity. Cancellation policy and trip protect price are subject to change from time to time without prior notification to the members.</p>
        <p><a href="#top">Go Back to the Top</a></p>
        <p><a name="25"></a>25. SPECIAL PROVISIONS APPLICABLE FOR MEMBERS OUTSIDE THE UNITED STATES<br>
        We aim to create a global activity forum with consistent standards for members. In this course, we also aim to respect the local governing laws. The below mentioned provision is applicable for members who interact with our website outside the United States:<br>
        1. You permit to have your content transferred and processed in the United States.<br>
        2. For Countries or locations which are embargoed by the United States, or are on the U.S. Treasury Department’s list of Specially Designated Nationals, you will not use any activities which are listed in our website.</p>
        <p><a href="#top">Go Back to the Top</a></p></div></article>
        <div class="row">
            <p style="text-align: right;"><a onclick="window.history.back();" style="cursor:pointer;">Click here to Return ...</a></p>
        </div>
    </div>
</div>


<style>
    *, *:before, *:after {box-sizing:  border-box !important;}

    .pagination-main {
        border: 1px solid rgb(23, 141, 164);
        display: inline-block;
        float: right;
        margin: 20px 0 0;
        padding: 5px;
    }
    .pagination-main a{
        border-left: 1px solid #e1e1e1;
        color: black;
        padding:6px 9px;
        text-decoration: none;
        cursor:pointer;
    }
    .active_page{
        background:#FD5E63;
        color:white !important;
    }

    #content {
        -moz-column-width: 18em;
        -webkit-column-width: 18em;
        -moz-column-gap: 1em;
        -webkit-column-gap:1em; 

    }

    .blog-row .item {
        display: inline-block;
        padding:  .25rem;
        width:  100%; 
    }

    .blog-row .blog-box {
        position:relative;
        display: block;
    }
</style>