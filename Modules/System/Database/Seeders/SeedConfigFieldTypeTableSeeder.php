<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\System\Entities\ConfigurationField;

class SeedConfigFieldTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigurationField::truncate();
        $configurations = [
            [
                'title' => 'Admin area website title',
                'configuration_type' => 'system_config',
                'detail' => 'Admin area title for adminstration level',
                'key' => 'admin-area-website-title',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Admin'
            ],
            [
                'title' => 'Admin area Logo',
                'configuration_type' => 'system_config',
                'detail' => 'Admin area logo',
                'key' => 'admin-logo',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Admin'
            ],
            [
                'title' => 'Admin area Dark Logo',
                'configuration_type' => 'system_config',
                'detail' => 'Admin area dark logo',
                'key' => 'admin-dark-logo',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Admin'
            ],
            [
                'title' => 'Admin area Dark Mini Logo',
                'configuration_type' => 'system_config',
                'detail' => 'Admin area dark mini logo',
                'key' => 'admin-mini-dark-logo',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Admin'
            ],
            [
                'title' => 'Admin area Mini Logo',
                'configuration_type' => 'system_config',
                'detail' => 'Admin area logo',
                'key' => 'admin-mini-logo',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Admin'
            ],
            [
                'title' => 'Admin Favicon',
                'configuration_type' => 'system_config',
                'detail' => 'Favicon used in admin area',
                'key' => 'admin-fav-icon',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Admin'
            ],
            [
                'title' => 'Admin Loader',
                'configuration_type' => 'system_config',
                'detail' => 'Loader used in admin area',
                'key' => 'loader-gif',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Admin'
            ],
            [
                'title' => 'Turn on Maintenance Mode',
                'configuration_type' => 'system_config',
                'detail' => 'Maintenance Mode On for the system',
                'key' => 'admin-maintenance-mode',
                'field_type' => 'checkbox',
                'status' => true,
                'user_configurable' => false,
                'options' =>
                '{
                    "on" : "On",
                    "off" : "Off",
                    "checked" : false
                }',
                'for_developer' => true,
                'group' => 'Admin'
            ],
            //Frontend
            [
                'title' => 'Website Name',
                'configuration_type' => 'system_config',
                'detail' => 'Website name',
                'key' => 'website-name',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Front'
            ],
            [
                'title' => 'Theme',
                'configuration_type' => 'system_config',
                'detail' => 'Select Theme For Frontend',
                'key' => 'theme',
                'field_type' => 'radio_button',
                'status' => true,
                'user_configurable' => false,
                'options' =>
                '{
                    "default" : "magazine",
                    "options" : {
                        "magazine": "Newsprk Magazine Theme",
                        "blog": "Aqum Blog Theme",
                        "optimal": "New Optimal"
                    }
                }',
                'for_developer' => true,
                'group' => 'Front'
            ],
            [
                'title' => 'Logo',
                'configuration_type' => 'system_config',
                'detail' => 'Logo of the site',
                'key' => 'logo',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Front'
            ],
            [
                'title' => 'Small Logo',
                'configuration_type' => 'system_config',
                'detail' => 'Small Logo of the site',
                'key' => 'small-logo',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Front'
            ],
            [
                'title' => 'Dark Logo',
                'configuration_type' => 'system_config',
                'detail' => 'Dark Logo of the site for dark theme',
                'key' => 'dark-logo',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Front'
            ],
            [
                'title' => 'Site maps per index',
                'configuration_type' => 'system_config',
                'detail' => 'Sitemaps per index',
                'key' => 'site-maps-per-index',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Front'
            ],
            //Contacts
            [
                'title' => 'Facebook Link',
                'configuration_type' => 'system_config',
                'detail' => 'Facebook Link',
                'key' => 'facebook-link',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Contacts'
            ],
            [
                'title' => 'Instagram Link',
                'configuration_type' => 'system_config',
                'detail' => 'Instagram Link',
                'key' => 'instagram-link',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Contacts'
            ],
            [
                'title' => 'Twitter Link',
                'configuration_type' => 'system_config',
                'detail' => 'Twitter Link',
                'key' => 'twitter-link',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Contacts'
            ],
            [
                'title' => 'Pinterest Link',
                'configuration_type' => 'system_config',
                'detail' => 'Pinterest Link',
                'key' => 'pinterest-link',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Contacts'
            ],
            [
                'title' => 'Linkedin Link',
                'configuration_type' => 'system_config',
                'detail' => 'Linkedin Link',
                'key' => 'linkedin-link',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Contacts'
            ],
            [
                'title' => 'Company Contact Number',
                'configuration_type' => 'system_config',
                'detail' => 'Company Contact Number',
                'key' => 'company-contact-number',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Contacts'
            ],
            [
                'title' => 'Company Address',
                'configuration_type' => 'system_config',
                'detail' => 'Company Address',
                'key' => 'company-address',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Contacts'
            ],

            //Dynamic contents
            [
                'title' => 'Footer about description',
                'configuration_type' => 'system_config',
                'detail' => 'Footer about description',
                'key' => 'footer-about-description',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Footer newsletter description',
                'configuration_type' => 'system_config',
                'detail' => 'Footer newsletter description',
                'key' => 'footer-newsletter-description',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Home Page Section One Limit',
                'configuration_type' => 'system_config',
                'detail' => 'Home Page First Post Limit',
                'key' => 'limit-home-section-one',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Home Page Section Two Limit',
                'configuration_type' => 'system_config',
                'detail' => 'Home Page Second Post Limit',
                'key' => 'limit-home-section-two',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Home Page Section Third Limit',
                'configuration_type' => 'system_config',
                'detail' => 'Home Page Third Post Limit',
                'key' => 'limit-home-section-three',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Home Page Section Fourth Limit',
                'configuration_type' => 'system_config',
                'detail' => 'Home Page Fourth Post Limit',
                'key' => 'limit-home-section-four',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Home Page Section Fifth Limit',
                'configuration_type' => 'system_config',
                'detail' => 'Home Page Fifth Post Limit',
                'key' => 'limit-home-section-five',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Home Page Sixth Third Limit',
                'configuration_type' => 'system_config',
                'detail' => 'Home Page Sixth Post Limit',
                'key' => 'limit-home-section-six',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Home Page Sixth Seventh Limit',
                'configuration_type' => 'system_config',
                'detail' => 'Home Page Seventh Post Limit',
                'key' => 'limit-home-section-seven',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Home Page Latest Post Limit (Top)',
                'configuration_type' => 'system_config',
                'detail' => 'Home Page Latest Post Limit (Top Section Posts)',
                'key' => 'limit-home-section-latest',
                'field_type' => 'number',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Home Page'
            ],
            [
                'title' => 'Related Topics information in post page',
                'configuration_type' => 'system_config',
                'detail' => 'Helper Message for realted topics',
                'key' => 'info-message-related-topics',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Info Message'
            ],
            [
                'title' => 'Featured Image information in post page',
                'configuration_type' => 'system_config',
                'detail' => 'Helper Message for featured image in post page',
                'key' => 'info-message-featured-image',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Info Message'
            ],
            //Google
            [
                'title' => 'Analytics Client ID',
                'configuration_type' => 'system_config',
                'detail' => 'Analytics Client ID to render Analytics Widget in Dashboard',
                'key' => 'analytics-client-id',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Google'
            ],
            [
                'title' => 'Adsense Script',
                'configuration_type' => 'system_config',
                'detail' => 'Adsense script',
                'key' => 'adsense',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Google'
            ],
            [
                'title' => 'Analytics Script',
                'configuration_type' => 'system_config',
                'detail' => 'Analytics Script',
                'key' => 'google-analytics',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Google'
            ],
            [
                'title' => 'Amp Analytics Script',
                'configuration_type' => 'system_config',
                'detail' => 'Amp Analytics Script',
                'key' => 'amp-google-analytics',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Google'
            ],
            [
                'title' => 'AMP adsense',
                'configuration_type' => 'system_config',
                'detail' => 'AMP adsense script',
                'key' => 'amp-adsense',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => true,
                'group' => 'Google'
            ],

            //Meta Tags
            [
                'title' => 'Robots tag',
                'configuration_type' => 'system_config',
                'detail' => 'Robots tag',
                'key' => 'robots-tag',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'Syndication Source',
                'configuration_type' => 'system_config',
                'detail' => 'Syndication Source',
                'key' => 'syndication-source',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'FB App ID',
                'configuration_type' => 'system_config',
                'detail' => 'FP APP ID meta tag',
                'key' => 'fb-app-id',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'FB Admins',
                'configuration_type' => 'system_config',
                'detail' => 'FP Admins',
                'key' => 'fb-admins',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'p:domain_verify',
                'configuration_type' => 'system_config',
                'detail' => 'Pinterest domain verification',
                'key' => 'p-domain-verify',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'Apple Touch Icon',
                'configuration_type' => 'system_config',
                'detail' => 'Apple Touch Icon',
                'key' => 'apple-touch-icon',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'RSS Feed',
                'configuration_type' => 'system_config',
                'detail' => 'Apple Touch Icon',
                'key' => 'rss',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'Favicon-32',
                'configuration_type' => 'system_config',
                'detail' => 'Favicon 32',
                'key' => 'favicon-32',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'Favicon-16',
                'configuration_type' => 'system_config',
                'detail' => 'Favicon 16',
                'key' => 'favicon-16',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'OG image',
                'configuration_type' => 'system_config',
                'detail' => 'Open Graph image for other pages',
                'key' => 'og:image',
                'field_type' => 'image',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'OG Type',
                'configuration_type' => 'system_config',
                'detail' => 'og:type meta tag',
                'key' => 'og:type',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'Website Meta title',
                'configuration_type' => 'system_config',
                'detail' => 'Metatitle for website (mainly home page)',
                'key' => 'website-meta-title',
                'field_type' => 'text_box',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            [
                'title' => 'Website Seo description',
                'configuration_type' => 'system_config',
                'detail' => 'Metadescription for website (mainly home page)',
                'key' => 'seo-description',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Metaitems'
            ],
            //Ads Management
            [
                'title' => 'Banner Ad (670x85)',
                'configuration_type' => 'system_config',
                'detail' => 'Banner Ad that is loaded after categories and displayed in home page and other places',
                'key' => 'banner-ad',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Google ads'
            ],
            [
                'title' => 'Sidebar Ad',
                'configuration_type' => 'system_config',
                'detail' => 'Sidebar Advertisement',
                'key' => 'sidebar-ad',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Google ads'
            ],
            [
                'title' => 'In-between Articles',
                'configuration_type' => 'system_config',
                'detail' => 'Inbetween Articles',
                'key' => 'between-articles-ad',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Google ads'
            ],
            [
                'title' => 'Big Banner Ad',
                'configuration_type' => 'system_config',
                'detail' => 'Big Banner Advertisement',
                'key' => 'big-banner-ad',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Google ads'
            ],
            [
                'title' => 'AMP Banner Ad (670x85)',
                'configuration_type' => 'system_config',
                'detail' => 'Banner Ad that is loaded after categories and displayed in home page and other places',
                'key' => 'amp-banner-ad',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Google ads'
            ],
            [
                'title' => 'AMP Sidebar Ad',
                'configuration_type' => 'system_config',
                'detail' => 'Sidebar Advertisement',
                'key' => 'amp-sidebar-ad',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Google ads'
            ],
            [
                'title' => 'AMP In-between Articles',
                'configuration_type' => 'system_config',
                'detail' => 'Inbetween Articles',
                'key' => 'amp-between-articles-ad',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Google ads'
            ],
            [
                'title' => 'AMP Big Banner Ad',
                'configuration_type' => 'system_config',
                'detail' => 'Big Banner Advertisement',
                'key' => 'amp-big-banner-ad',
                'field_type' => 'text_area',
                'status' => true,
                'user_configurable' => false,
                'options' => null,
                'for_developer' => false,
                'group' => 'Google ads'
            ],
        ];

        foreach($configurations as $c){
            ConfigurationField::updateOrCreate([
                'title' => $c['title'],
                'configuration_type' => $c['configuration_type'],
                'detail'=>$c['detail'],
                'key' => $c['key'],
                'field_type' => $c['field_type'],
                'status' => $c['status'],
                'user_configurable' => $c['user_configurable'],
                'options' => $c['options'],
                'for_developer' => $c['for_developer'],
                'group' => $c['group'],
            ]);
        }
    }
}
