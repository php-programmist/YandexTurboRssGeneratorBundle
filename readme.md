# YandexTurboRssGeneratorBundle
This bundle for Sumfony 4-5 provides service witch allow you to generate RSS feed for Yandex Turbo pages.

## Installation
```console
composer require php-programmist/yandex-turbo-rss-generator-bundle
```
Before use follow Configuration section instructions
## Configuration
Create file config/packages/yandex_turbo_rss_generator.yaml:
```yaml
yandex_turbo_rss_generator:
    yandex_id: 12345678
    language: 'ru-RU'
    date_format: 'D, d M Y H:i:s e'
```
In param yandex_id you need to specify ID of your Yandex.Metrika counter for current site

date_format - is string of date format for PHP function **date**

## Usage
First you need to create class that implements PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\RssAdapterInterface. That class must implement method **getItems**, which provides array of **RssItem** objects. Each **RssItem** objects corresponds to one turbo-page.

You may want extend PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\RssBaseAdapter class.

Example of adapter:
```php
//src/Adapter/RssContentAdapter.php
namespace App\Adapter;

use App\Entity\Content;
use PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\BasePageInterface;
use PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\RssBaseAdapter;
use PhpProgrammist\YandexTurboRssGeneratorBundle\RssItem;

class RssContentAdapter extends RssBaseAdapter
{
    protected function adapt(array $original_items, BasePageInterface $base_page)
    {
        /** @var Content $original_item */
        foreach ($original_items as $original_item) {
            $item = new RssItem(
                $original_item->getId(),
                $original_item->getPath(),
                $original_item->getName(),
                $original_item->getDate(),
                $original_item->getText()
            );
            $item->setAllBreadcrumbs('Home',$base_page);
            $this->addItem($item);
        }
    }
}
```
This adapter can transform collection of Content entities ($original_items) to array of **RssItem**.

Also you need create BasePage object (PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\BasePage) with information about **parent** of turbo-pages. You need to specify Title, Description and Path to parent-page
```php
//src/Controller/NewsController.php
namespace App\Controller;

use PhpProgrammist\YandexTurboRssGeneratorBundle\Adapters\BasePage;
use PhpProgrammist\YandexTurboRssGeneratorBundle\YandexTurboRssGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/news/rss.xml", name="news_rss")
     */
    public function rss(ContentRepository $content_repository)
    {
        $items     = $content_repository->findAll();
        $base_page = new BasePage('News','Channel description','/news/');
        $adapter   = new RssNewsAdapter($items, $base_page);

        return $this->rss_generator->render($adapter, $base_page);
    }
}
```
