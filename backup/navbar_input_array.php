<?php

function navbar($currentLocation = []) {
    $location = $currentLocation;
    $locationSteps = count($location);

    echo '
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            ';

    for($i = 0; $i < $locationSteps; $i++) {
        echo '
            <span class="navbar-text">/</span>
            <li class="nav-item';
        if($i == $locationSteps - 1) {
            echo ' active';
        }
        echo '"><a class="nav-link" href="#">'.$location[$i].'
                </a>
            </li>
        ';
    }

    echo '
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item navbar-right">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                            <li class="nav-item navbar-right">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
    ';
}

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Functional Forum</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="js/scripts.js" type="text/javascript" ></script>
</head>

<body>

<?php navbar(['Announcements', 'Important', 'Changes to the forum']);    ?>

<!-- <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <span class="navbar-text">-></span>
            <li class="nav-item">
                <a class="nav-link " href="#">Category</a>
            </li>
            <span class="navbar-text">-></span>
            <li class="nav-item">
                <a class="nav-link" href="#">Forum</a>
            </li>
            <span class="navbar-text">-></span>
            <li class="nav-item">
                <a class="nav-link active" href="#">Topic</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item navbar-right">
                <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item navbar-right">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav> -->

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec tellus eu turpis volutpat rhoncus. Curabitur viverra tempus enim, eget iaculis odio rutrum eget. Vivamus auctor nisl nec quam imperdiet, ac molestie enim viverra. Sed ac ipsum quis quam tempor ornare ac eget quam. Morbi ut quam vitae sapien efficitur venenatis sed ut magna. Sed facilisis, erat eget venenatis euismod, arcu metus iaculis velit, a volutpat felis velit id enim. Ut maximus lorem ante, et consequat nisi faucibus ac. Ut imperdiet fermentum ligula, et tempus magna sagittis non. Nam maximus neque a dolor rhoncus auctor.

Vivamus commodo rhoncus nulla, a cursus turpis faucibus id. Mauris tincidunt congue metus, in faucibus ex interdum nec. Duis eu quam a lacus vehicula sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam tincidunt id nisl at volutpat. Suspendisse potenti. Ut egestas risus placerat blandit pellentesque. Fusce in vehicula arcu. Proin id auctor tellus. Ut sed lobortis lorem. Morbi nibh lorem, dignissim suscipit urna sit amet, venenatis volutpat justo.

Sed eget lorem in leo pellentesque semper egestas vel mi. Vestibulum finibus ante at mauris sollicitudin vestibulum. Morbi malesuada dignissim leo, ut pellentesque odio suscipit a. Duis posuere, velit in ornare tempor, metus odio interdum nulla, vel fringilla elit enim id massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam neque lacus, ornare non cursus eget, malesuada et mauris. Pellentesque ipsum libero, consequat non lacinia at, tristique nec dolor. Proin convallis volutpat felis sit amet viverra. Cras luctus, ante et pulvinar dignissim, massa orci tincidunt sem, sed lacinia leo orci varius lorem. Nam scelerisque ornare orci eget finibus. Vestibulum vel porttitor quam. Aenean et nibh sed eros tincidunt maximus in a felis. Proin nec sapien sed nulla accumsan congue ut ut lorem. Curabitur leo est, vulputate eget ante id, semper cursus lectus.

Cras euismod, odio ut mollis lobortis, lectus elit euismod mi, quis convallis metus lorem nec nunc. Phasellus vitae elit sed neque commodo cursus. Morbi vehicula nulla vitae velit tristique, ac vulputate dolor sodales. In semper lorem id mi mattis ornare. Nam et velit quis elit pulvinar venenatis. Ut nec congue ligula, vel semper dolor. Sed eget bibendum ex, laoreet placerat diam.

Aenean nibh orci, molestie vel urna sed, interdum ultrices dolor. In eget gravida lectus. Cras semper, ipsum ut bibendum lobortis, massa nunc placerat diam, vestibulum venenatis augue enim eu dui. Nullam sollicitudin consequat nisl vel malesuada. Fusce rhoncus lorem a massa rutrum dictum. Nullam non purus vel nunc rutrum dignissim nec at ipsum. Phasellus convallis ultrices turpis sit amet vestibulum. Nullam a neque sit amet sapien vehicula iaculis. Nullam leo lectus, consectetur eu mauris et, molestie semper ipsum.

Aenean blandit augue ut diam hendrerit condimentum. Suspendisse et porta risus, a dictum urna. Aliquam vel cursus urna, eu auctor sem. Donec eu mauris iaculis, fringilla sapien eget, viverra ex. In hac habitasse platea dictumst. Duis vestibulum accumsan pretium. Nam leo lectus, vulputate sed maximus vitae, varius et ligula. Pellentesque feugiat eu nulla non maximus. Nunc mattis eros ac lacus semper efficitur. Etiam dignissim dolor ut interdum dignissim. Sed non neque vitae est placerat sagittis.

Phasellus ac efficitur mauris. Quisque porta mollis urna efficitur euismod. Nunc sollicitudin a metus in sollicitudin. Fusce maximus turpis purus, sit amet porttitor quam dapibus ac. Sed sit amet fermentum felis. Vivamus in lacinia eros, et cursus eros. In augue lacus, cursus nec fringilla quis, imperdiet id lectus. Donec fermentum massa eu justo tristique tempor. Ut dapibus arcu justo, sed rhoncus erat consectetur in. Duis dictum tortor risus, ut porta enim lacinia eu. Fusce id lacinia est, luctus posuere nibh.

Vivamus sed ullamcorper neque. Pellentesque ultrices a ipsum non dignissim. Maecenas condimentum, erat non volutpat efficitur, nunc nibh venenatis sapien, ac posuere lacus augue in diam. Ut tellus ante, pulvinar non ipsum eget, auctor maximus lectus. Curabitur lorem massa, sodales a urna ut, tristique facilisis risus. Nullam id pharetra diam. Duis finibus ultrices tristique. Nam a leo ac urna maximus fermentum id ac enim.

Sed volutpat justo vitae purus volutpat bibendum. Etiam et sagittis mi, posuere tristique nisl. Donec fringilla lacinia lorem et aliquam. Pellentesque pretium hendrerit efficitur. Quisque efficitur ipsum ut odio convallis venenatis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pulvinar tempor diam lacinia varius. Phasellus volutpat neque vitae orci egestas viverra. Suspendisse cursus mattis turpis, eu hendrerit odio vehicula id. Aenean efficitur nunc aliquet, lacinia metus in, sagittis diam.

Maecenas ut mollis risus. Etiam felis leo, placerat feugiat ullamcorper non, mattis eu neque. Etiam vitae est erat. Maecenas ullamcorper, massa ac tincidunt molestie, est mauris rhoncus ipsum, a varius enim nibh vel ligula. Proin eleifend non magna sed ullamcorper. Quisque placerat, felis non ornare imperdiet, arcu elit ultricies felis, at cursus nulla sem ut metus. Donec viverra sem sit amet molestie interdum. Fusce velit urna, ultrices quis nunc eget, aliquam viverra metus. Pellentesque congue laoreet enim, at sollicitudin augue luctus id. Aenean sit amet consectetur leo. Nullam ac laoreet dui. Praesent tristique eleifend tellus, eu vehicula nisi sagittis at. Vivamus pretium pretium arcu sit amet auctor. Vivamus at magna ante. Fusce consequat arcu pharetra ante aliquet scelerisque.

Sed non mi commodo, dignissim nunc nec, lobortis ligula. Sed malesuada orci convallis pretium aliquet. Etiam posuere nec leo ut finibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque velit dolor, eleifend non nulla sed, sollicitudin suscipit orci. Etiam condimentum tortor mi. Maecenas pretium diam id libero consequat fringilla.

Sed enim ipsum, luctus ut nunc ut, molestie fringilla erat. Morbi ut urna nec neque elementum posuere. Fusce a quam mi. Nunc quis risus augue. Cras felis arcu, rhoncus in euismod eget, sodales ac nisi. Maecenas vulputate eget eros vel rutrum. Nam fringilla non metus ut vestibulum. Etiam eleifend est in nulla ullamcorper, ac lacinia diam iaculis. In hac habitasse platea dictumst. Nullam a egestas libero, ac finibus magna. Aenean consequat aliquet faucibus. Pellentesque tempor ornare nisl, at gravida arcu mattis nec. Curabitur lorem tellus, commodo sed faucibus ac, cursus nec turpis. Donec consectetur suscipit felis, nec ullamcorper dui vehicula eu. Aliquam feugiat elit ut ligula volutpat rhoncus. Sed lectus metus, pellentesque ut lorem ac, consectetur pulvinar metus.

In vel gravida ante, vel semper elit. Sed lacinia, arcu non efficitur mattis, sapien nunc sollicitudin tortor, fringilla interdum dui sapien eget massa. In vel vehicula augue, id interdum magna. Mauris blandit nec leo quis scelerisque. Praesent sollicitudin arcu vestibulum tempor rhoncus. Suspendisse potenti. Quisque lobortis neque non metus laoreet fermentum. Nulla facilisi. Cras fringilla eleifend dui sed placerat. Donec venenatis odio magna, et maximus libero finibus eget. Aenean a auctor purus. Pellentesque sed augue metus. Maecenas pulvinar ac diam a semper. Nullam ultricies diam vitae tincidunt viverra. Morbi tempor, tellus malesuada suscipit egestas, odio nunc dictum lectus, ac malesuada ligula libero dignissim mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.

Sed finibus dui volutpat ultricies maximus. Praesent vitae enim sed dolor malesuada congue in eu dolor. Cras varius, purus non blandit tincidunt, tortor turpis varius turpis, vel dapibus turpis quam vel tellus. Aliquam sollicitudin commodo quam et finibus. In hac habitasse platea dictumst. Donec sed fermentum turpis. Fusce at sollicitudin augue. Nullam ultrices sodales vestibulum. Aliquam suscipit sollicitudin dictum. Vestibulum eros odio, convallis ac massa id, aliquam suscipit ante. Nunc egestas malesuada tempus. Suspendisse potenti. Quisque et imperdiet ligula. Aliquam quam odio, dictum at velit ac, molestie tristique est.

Etiam sem velit, pulvinar a neque in, semper varius est. Vestibulum tellus magna, semper tincidunt scelerisque at, iaculis a ipsum. Phasellus non diam egestas, sollicitudin orci at, placerat erat. Integer eros quam, porta et lorem id, condimentum aliquam ante. Sed lobortis imperdiet ex fringilla fringilla. Sed ultrices, sem et fringilla dignissim, justo nisl vulputate odio, non sagittis dui dui ac metus. Morbi eu pharetra nisl. Nunc eu tempor nunc.

Nulla id magna volutpat, malesuada enim eu, consectetur ex. Donec quis diam eget ligula hendrerit rhoncus et et neque. Aenean et quam non magna semper venenatis. In eu consequat velit, ac gravida leo. Duis eu lacus faucibus, sagittis ex a, dignissim dolor. Mauris non augue ut est pellentesque dictum sed in ligula. Sed sed purus id diam rhoncus mattis a vel lectus.

Morbi tincidunt, magna ut feugiat congue, augue dui bibendum felis, et aliquet odio lacus eu elit. Nulla a venenatis nisi. Donec at lectus turpis. Donec sit amet urna ac eros vehicula imperdiet. Etiam sit amet pretium enim, vitae sagittis lacus. Maecenas ac enim feugiat, euismod mauris sed, cursus justo. Praesent lobortis placerat sodales. Sed ultricies egestas magna a bibendum. Integer fringilla mi a commodo varius. Nunc semper ultrices massa, sit amet pretium augue semper sit amet. Nam sagittis elit erat, sagittis semper libero fringilla vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.

Aenean luctus dolor velit, at viverra ligula imperdiet quis. Donec vehicula rutrum tortor non eleifend. Nam pellentesque quam eros. Nunc consequat facilisis ligula, eget tempus nunc placerat sed. Pellentesque sagittis nisl non enim tempus luctus. Sed ac enim ipsum. Morbi eget risus porta, laoreet magna in, gravida tellus. Suspendisse egestas nec urna ut elementum. Sed massa nisl, faucibus sed massa ac, faucibus interdum justo. Maecenas tempus, purus eget sodales accumsan, nibh felis fringilla leo, at scelerisque urna ipsum at enim. Nunc pharetra quis purus vitae hendrerit. Ut ligula diam, blandit in dictum sit amet, interdum non nibh. Nam eleifend, risus ut scelerisque elementum, justo erat laoreet diam, eget bibendum odio quam et ex.

Phasellus tortor lacus, vestibulum convallis purus tincidunt, malesuada porttitor ipsum. Suspendisse facilisis magna vel tincidunt scelerisque. Praesent lorem est, blandit id consectetur tempor, sodales in nunc. Fusce non molestie nunc. Vestibulum rutrum orci ut varius ultrices. Phasellus laoreet pulvinar commodo. Proin luctus rutrum lacus in convallis. Phasellus condimentum vitae nisi aliquet aliquam. Nunc hendrerit, ipsum sit amet aliquam sagittis, ipsum enim suscipit tellus, quis facilisis felis ante at libero. Vestibulum auctor lectus ac urna pretium ullamcorper. Phasellus a justo et elit euismod interdum vel eu eros. Curabitur quis euismod urna, id lobortis urna. Aenean euismod at velit sit amet hendrerit.

Integer iaculis enim quis malesuada blandit. Nam sit amet mauris augue. In a nibh diam. Aenean non lacus quis elit pretium hendrerit sed id nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec ullamcorper orci, vulputate porta diam. Phasellus et sollicitudin erat. In eu condimentum dui. Aliquam molestie porttitor ullamcorper. Cras vestibulum maximus porta. Nullam interdum venenatis lectus ac facilisis. Phasellus eros arcu, porta a mattis eget, pulvinar sed lectus.

Morbi volutpat malesuada pulvinar. Aenean aliquet nunc quis massa pellentesque efficitur eget sit amet lorem. Curabitur quis nunc eget ligula porttitor vestibulum ut sed quam. Donec scelerisque risus ac erat tempus, non cursus leo lobortis. Duis auctor hendrerit erat, eu posuere risus vulputate vulputate. Fusce sem sem, aliquam a nibh quis, aliquet facilisis ex. Phasellus vitae malesuada urna. Cras at maximus dui. In tincidunt in nunc sit amet laoreet.

Ut ac tortor leo. Cras sit amet mauris lectus. Nunc at metus turpis. Cras accumsan cursus nibh, vitae posuere odio imperdiet tincidunt. Sed quis placerat lorem. Phasellus non blandit metus. Mauris vel turpis lacinia, interdum sapien ac, porttitor neque. Duis in facilisis est, finibus dapibus lacus. Aenean vitae eros eget augue ornare laoreet. Fusce ut aliquam tellus. Mauris ultrices augue lectus, ut vehicula massa faucibus eu. Vestibulum non ex id odio commodo rhoncus sit amet sit amet eros. Etiam sit amet quam vel ipsum elementum venenatis nec vitae urna. Integer faucibus fermentum porttitor. Sed pellentesque erat nulla, sit amet pulvinar erat luctus sit amet.

Quisque placerat eros ut aliquet consectetur. Vestibulum interdum blandit mattis. Aenean tincidunt tortor et orci posuere, vitae malesuada lectus mollis. Etiam eget laoreet lacus. Integer at erat et dui pulvinar tempor ut at ex. Sed finibus nibh dolor. Aenean quis justo sit amet risus pharetra porttitor ut ut neque. Quisque luctus tincidunt massa eu pellentesque. Fusce ultricies elit ut urna dignissim lobortis.

Nullam hendrerit nunc dolor. Phasellus maximus ante id lobortis molestie. Etiam eu libero dui. Mauris in facilisis urna. Donec non arcu ipsum. Donec laoreet maximus dui. Pellentesque volutpat sed ligula non imperdiet. Morbi semper, metus at bibendum ultricies, massa massa fermentum ligula, sed sollicitudin urna ex sit amet leo. Cras et ornare risus. Nunc tincidunt fermentum dolor, non cursus tortor commodo sed. Donec in dolor a urna imperdiet pellentesque quis nec turpis. Duis justo tortor, feugiat non orci a, porttitor suscipit magna. Vestibulum eleifend ipsum iaculis, tempus mauris et, laoreet nibh.

Nullam eget ullamcorper nisl. Ut sit amet eleifend mauris. Quisque facilisis mauris eu interdum porttitor. Quisque malesuada nisi non risus porta, quis sodales est scelerisque. Donec augue tortor, pharetra ut volutpat ut, pharetra in lectus. Maecenas nec lobortis lorem. Donec tristique erat sit amet lacinia ultricies. Nunc interdum condimentum turpis, a laoreet arcu. Praesent nec elementum felis. Quisque at pretium augue.

Donec risus libero, luctus vitae eros vitae, accumsan efficitur erat. Curabitur suscipit nisi ut metus ultrices laoreet. Cras tempor euismod nulla, a maximus diam interdum sit amet. Nunc finibus finibus libero, ut pharetra tellus finibus quis. Mauris nulla nisi, dignissim nec magna ac, aliquam dignissim enim. Curabitur cursus lacus quis dolor vulputate, condimentum egestas libero gravida. Aenean leo odio, euismod sit amet consectetur in, semper id elit. Cras vitae ultrices nunc. Nulla condimentum diam arcu, non malesuada lorem interdum eu. Cras euismod leo lacus, vel tincidunt ipsum molestie ut. Nam molestie quam dignissim ex bibendum posuere. Vivamus cursus dui dui, quis faucibus purus aliquam sed. In scelerisque felis vel lobortis tempor. Vivamus tempor fermentum tincidunt. Sed ac vulputate dui. Ut sit amet convallis massa.

Quisque pretium tellus in orci fermentum, nec congue elit euismod. Quisque at commodo sapien, id tristique metus. Duis vitae ipsum tempus, eleifend mi non, suscipit lorem. Aliquam in blandit tortor, non pharetra dui. Quisque iaculis feugiat ante, congue fringilla justo. Nulla dapibus eros metus, ut tincidunt neque faucibus eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque lacinia felis id volutpat. Etiam augue elit, luctus non ipsum non, rutrum sollicitudin tellus. Nullam ac ullamcorper erat, et pulvinar metus.

Nam commodo enim id nisl fringilla, non ullamcorper lacus gravida. Sed scelerisque elit at volutpat accumsan. Integer mi purus, eleifend at metus a, lacinia dignissim magna. Nam vitae diam eu orci hendrerit condimentum sit amet a urna. Donec venenatis velit nec elementum sollicitudin. Nulla sodales, nulla hendrerit semper dapibus, arcu elit aliquam tellus, at finibus justo augue at risus. Duis lobortis suscipit sem. Proin rutrum turpis ut ex elementum, vitae commodo eros mattis. Suspendisse eu arcu et enim malesuada vulputate sed id nisi.

Donec congue mi eu erat tristique ullamcorper. Nunc egestas vulputate lectus a auctor. Morbi laoreet urna diam, vitae vehicula sapien dapibus id. Ut nec arcu euismod arcu egestas lobortis. Nunc id dolor nisl. Nam ut ultricies ante, vitae cursus purus. Pellentesque gravida, eros at fermentum laoreet, lacus justo luctus neque, at auctor mauris augue nec tortor. Maecenas at felis lorem. Vivamus est lacus, iaculis a bibendum ac, volutpat cursus lacus. Morbi a malesuada purus. Vestibulum nec metus tempus, laoreet ipsum eu, luctus erat. Curabitur scelerisque est at cursus blandit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum gravida hendrerit libero, eu cursus ipsum tempus sed. Nullam a enim a magna blandit ullamcorper.

Mauris quis ullamcorper libero. Morbi tempus elit non finibus commodo. Nulla in arcu mi. Suspendisse efficitur magna libero, vel vulputate tellus commodo ac. Morbi placerat a odio in tempor. Praesent sodales euismod nulla eu fermentum. Nullam eleifend ante et porttitor cursus. Sed hendrerit hendrerit vulputate. Integer tellus augue, ultricies id sodales tempor, ullamcorper non erat. Nulla facilisi. Donec et mauris ut augue malesuada cursus.

Duis dignissim lectus commodo nibh finibus, sit amet mattis lectus tempus. Vestibulum id neque ac turpis volutpat ullamcorper non quis felis. Fusce suscipit iaculis ipsum. In mollis risus id metus rutrum luctus. Sed in enim quis quam viverra accumsan. Phasellus volutpat augue lacus, et euismod libero malesuada scelerisque. Vivamus est magna, cursus eu congue vel, vehicula a arcu. Fusce ullamcorper luctus ullamcorper. Duis metus orci, consequat in iaculis eget, elementum sed ligula. Duis lacinia ligula sed blandit vulputate. Aliquam interdum sagittis rhoncus. Donec eu sapien est.

Curabitur gravida sed mauris id dignissim. Pellentesque sed vestibulum turpis. Proin massa dolor, lacinia ac neque pellentesque, pharetra porta orci. Donec lorem mauris, lacinia sit amet ullamcorper a, bibendum sit amet eros. Etiam eu pretium odio. Etiam efficitur enim vitae eros pretium, et rutrum risus fringilla. Donec sed magna quam. Aliquam a lobortis magna, id tincidunt nisi. Morbi in ipsum vitae augue interdum suscipit. Sed suscipit magna dolor, nec aliquam mauris volutpat quis. Sed condimentum ex sit amet velit mollis aliquam. Ut lobortis, tortor sit amet convallis tincidunt, massa justo lacinia massa, id finibus magna ipsum in nibh.

Nunc quis dui dolor. Sed lectus mi, placerat a nibh in, tristique finibus quam. Nam enim mi, vestibulum non fringilla ut, tincidunt sit amet dolor. Phasellus ut nibh eu diam ultricies interdum non et ante. Sed ac accumsan erat. Nullam massa erat, interdum sed scelerisque eu, aliquam quis ligula. Mauris lacus nisi, elementum vitae placerat non, varius quis mi. Fusce accumsan sapien felis. In elementum, massa nec iaculis viverra, enim nisl auctor neque, quis gravida tellus quam vitae urna. Aliquam erat volutpat. Suspendisse vehicula arcu eget mi vulputate consectetur.

Nullam congue feugiat scelerisque. Suspendisse nunc enim, iaculis at iaculis ac, hendrerit dapibus tellus. Morbi enim arcu, pharetra at arcu nec, sollicitudin pellentesque felis. Nunc nec molestie ipsum, id venenatis erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse eleifend scelerisque justo, in efficitur ante. Integer tincidunt placerat odio. Maecenas interdum nunc vel malesuada porttitor.

Proin mauris ante, bibendum et mollis nec, placerat vel lacus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris in est non erat faucibus mollis. Quisque sit amet nibh vel elit consequat pretium. Donec aliquam, nisl a commodo euismod, nibh ligula volutpat nisl, sit amet pulvinar tellus enim ut nunc. Nulla viverra, lectus viverra placerat egestas, neque eros venenatis ipsum, id sollicitudin orci eros at nibh. Cras rutrum auctor nibh vel tincidunt. Integer euismod felis sit amet sem auctor consectetur. Ut ultricies pretium imperdiet. Nulla et est euismod, venenatis lorem ac, condimentum erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin sagittis mollis tellus, non porttitor nulla fringilla eget. Mauris convallis dolor odio, et luctus massa vehicula sed. Fusce vitae turpis luctus, semper purus vitae, scelerisque enim.

Nulla eget feugiat orci. Quisque elementum scelerisque ante at semper. Morbi vitae ornare urna. Sed luctus risus quam, quis aliquet urna sagittis et. Nunc diam massa, ullamcorper eu augue at, ultrices vestibulum tellus. Fusce ut ipsum sed magna pulvinar blandit a imperdiet turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec fermentum odio risus, a interdum nibh laoreet id. Ut dictum in quam sed elementum. Fusce ex sapien, tempus faucibus iaculis accumsan, dignissim eu diam. Maecenas viverra nisi nisi, vulputate laoreet mauris molestie ac. Ut justo dui, consequat non porttitor in, efficitur et velit. Donec sodales, libero at accumsan condimentum, metus enim luctus urna, sagittis feugiat urna nisl in ligula. Sed accumsan accumsan mi vitae molestie.

Nulla interdum, neque at vulputate porta, nisi velit egestas quam, quis accumsan libero purus id ipsum. Suspendisse non felis non orci venenatis blandit eget at dolor. Morbi erat erat, rutrum eu turpis vel, feugiat semper ipsum. Praesent sagittis nisi ac nibh aliquam pretium. Donec rutrum velit sed viverra euismod. Integer ut facilisis ex. Quisque feugiat, dui vel fringilla posuere, turpis ipsum iaculis tellus, quis hendrerit enim mi mattis ex. Morbi ullamcorper sem at leo auctor, eget condimentum nisi pharetra. Nullam interdum eu lectus in commodo. Sed pretium sodales quam, quis malesuada nibh egestas et.

Vivamus nisl urna, viverra eget ipsum quis, suscipit rhoncus augue. Nunc eu suscipit massa. In hac habitasse platea dictumst. Quisque eu vulputate dolor. Duis accumsan consectetur feugiat. Ut felis massa, pharetra non pulvinar nec, convallis vitae nulla. Nam eu magna pharetra eros porttitor mattis at et lacus. Aliquam iaculis pellentesque metus eget accumsan. Cras facilisis lorem tortor, et hendrerit metus lacinia eu.

Suspendisse tincidunt vitae sapien sagittis laoreet. Nulla gravida, diam eget tincidunt tincidunt, dolor mauris egestas massa, non aliquam nibh lorem id nibh. Ut at rhoncus nulla. Donec blandit magna magna, rhoncus bibendum lorem convallis eget. Praesent bibendum nibh sed tincidunt auctor. Phasellus massa odio, pellentesque non dapibus in, convallis ut tellus. Morbi sollicitudin eleifend mollis. Phasellus non ante mi.

Praesent a rutrum ante. Vivamus bibendum, felis sit amet elementum dignissim, urna turpis viverra nisi, vel consectetur tellus ante id purus. Cras blandit, enim non tempor vestibulum, nisi est placerat ex, sit amet accumsan purus felis vel lorem. Maecenas dignissim turpis semper purus malesuada egestas. Aenean sit amet tortor nec sem convallis elementum. Vestibulum magna leo, varius a dapibus sed, elementum a orci. Pellentesque non nunc vulputate, ultrices lectus ac, efficitur diam. Curabitur est ante, viverra vitae risus sit amet, tincidunt porta libero. Nulla nisl libero, gravida a lacinia vitae, luctus quis arcu.

Nullam orci purus, hendrerit eu orci a, lacinia dignissim ligula. Quisque facilisis sapien eget massa pharetra, a feugiat mauris placerat. Sed vestibulum tempor rhoncus. Etiam varius tortor sem, vel eleifend est scelerisque sed. Proin ut diam ut mauris vehicula lobortis vel eget ipsum. Donec ut commodo risus, vitae pulvinar lectus. Quisque in iaculis magna. Aenean a posuere ante. Nam auctor hendrerit nunc quis laoreet. Aliquam auctor suscipit tellus, ac pharetra lectus condimentum sed. Integer eu sollicitudin diam. Sed at eleifend diam.

Interdum et malesuada fames ac ante ipsum primis in faucibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent lobortis mi nisi, vel iaculis risus varius sodales. In vestibulum eget sem vel venenatis. Duis aliquet non lorem ac laoreet. Vivamus a nulla id enim maximus commodo. Proin non porttitor velit. Curabitur sit amet eros faucibus, consectetur risus non, consectetur leo. Nam cursus efficitur lorem id facilisis. Vestibulum non ante nibh. Nam scelerisque pellentesque congue.

Nulla eget quam quis risus interdum blandit ut nec felis. Nullam venenatis volutpat rhoncus. Aliquam auctor volutpat lacus. Aliquam erat volutpat. Suspendisse varius auctor nisi, ut faucibus mi scelerisque a. Cras nunc orci, interdum eu facilisis vitae, semper sit amet urna. Sed suscipit non turpis sit amet dictum. Morbi viverra, nunc vel placerat mollis, quam diam pulvinar turpis, ut suscipit est tortor et massa. Pellentesque venenatis libero eget ligula ornare, sit amet congue justo ultrices. Fusce egestas arcu justo, at mattis sapien accumsan et. Aenean ligula leo, dignissim a mi nec, viverra maximus massa. Proin vulputate sit amet lacus at viverra. Maecenas sollicitudin accumsan orci nec blandit.

Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse vestibulum ligula nunc, sit amet varius tortor lacinia sit amet. Aliquam enim ante, imperdiet in facilisis sed, auctor porttitor ex. Etiam nisi odio, iaculis non tortor in, fermentum aliquet augue. Proin commodo rhoncus orci, in tincidunt enim tristique quis. Vestibulum volutpat est vitae quam iaculis vulputate. Praesent aliquet urna at velit cursus fermentum. Ut id pretium sapien. Pellentesque eu dui nec massa viverra suscipit id vitae nisl. Aenean libero dui, viverra sed pulvinar quis, tincidunt eu tortor. Aenean sagittis ultrices mi, ut interdum nisl eleifend sit amet. Vivamus maximus justo quis elementum condimentum. Vivamus sollicitudin fringilla nunc, ac pretium tellus convallis sit amet. Donec consectetur varius risus eget efficitur. Aenean in cursus magna, a vestibulum risus.

Quisque massa est, bibendum sed ultricies at, accumsan luctus justo. Duis eu molestie tellus. In hac habitasse platea dictumst. Maecenas pretium vehicula sollicitudin. Praesent id suscipit erat, non vulputate sem. Nam eu gravida erat, a aliquet sem. Proin fringilla lorem sed magna congue, quis porta felis sollicitudin. Nullam vel diam at lacus molestie eleifend. In hac habitasse platea dictumst. Vivamus in ante non neque egestas volutpat et et quam. Vivamus vel eros a risus convallis varius eu ultricies mauris.

Integer rhoncus dapibus leo, porttitor hendrerit nisl finibus vel. Quisque sodales ut velit vel hendrerit. Donec vitae malesuada eros. Duis pulvinar est non dui egestas, in fringilla velit ullamcorper. Etiam lobortis vestibulum posuere. Suspendisse auctor, felis a placerat egestas, ligula erat auctor orci, at suscipit enim quam eget sem. Nam efficitur eget risus non pharetra. Nullam finibus sed elit quis dictum. Morbi ultrices ligula ut vestibulum scelerisque. Maecenas ullamcorper ut nulla a venenatis. Vivamus malesuada porta quam, tincidunt mollis ligula porta vitae. Pellentesque volutpat semper tortor, et rhoncus ex. Aliquam sed consequat diam, sed dictum purus. Suspendisse pharetra auctor tellus non faucibus. In vel leo ac libero suscipit mollis. Donec ultricies sagittis tellus a ullamcorper.

Fusce hendrerit sollicitudin scelerisque. Vestibulum et tristique justo, id accumsan felis. Morbi porta nisl urna, vel feugiat sapien condimentum a. In hac habitasse platea dictumst. Sed ut tortor gravida, dictum nisi et, vestibulum sapien. Etiam rhoncus erat non eros auctor commodo. Suspendisse eget mi ut ex sagittis sagittis sed vitae est. Duis suscipit magna nec gravida congue. In lacinia risus vel tincidunt rutrum. Aenean cursus dui velit, ut malesuada purus cursus semper. Pellentesque dapibus sapien eget urna bibendum congue. Donec ac lacus eget libero ultrices gravida at ac urna. Curabitur accumsan ullamcorper dolor, non condimentum metus dictum id. Ut aliquam placerat ante ac varius. Proin est elit, dictum vitae massa in, efficitur molestie massa. Cras ac nisl eu magna condimentum mattis et eget ante.

Ut blandit vitae dolor ut suscipit. Pellentesque lobortis lacus sapien, vitae ullamcorper lectus luctus eget. Vestibulum aliquam velit non sapien laoreet, vel imperdiet libero dapibus. Nulla dignissim magna at pretium accumsan. Aliquam molestie consectetur consequat. Mauris egestas est sem, nec vehicula nisi finibus ultrices. Nunc mi nisi, feugiat at sagittis non, commodo vel nisi. Aenean eu vestibulum neque, at interdum tortor. In hac habitasse platea dictumst. Integer id turpis dapibus, faucibus arcu a, laoreet diam. Proin nec varius enim. Nullam justo massa, aliquet nec ipsum sed, condimentum euismod dolor. Suspendisse lectus ipsum, bibendum at tempus facilisis, ultrices eu ligula. Aenean mattis eget nisi id lacinia. Nullam faucibus nec lacus sed pretium. Proin condimentum cursus orci, eu luctus massa aliquam at.

Cras sem lorem, dignissim eget accumsan non, hendrerit scelerisque mauris. Fusce pulvinar lectus at dui fringilla placerat et pharetra arcu. Fusce tristique, mauris non ornare finibus, nisl est scelerisque massa, eu varius tortor nisl vel sapien. Vestibulum elementum, elit nec iaculis elementum, enim eros cursus urna, et mollis lorem magna nec augue. Quisque convallis convallis sem, eget iaculis dolor volutpat ullamcorper. Cras laoreet quam at nunc tempus, eu sodales erat aliquam. Suspendisse consectetur ante in magna fermentum, et pretium sem congue. Aliquam pharetra quam eu felis ultricies, et finibus massa accumsan. Vivamus odio elit, rhoncus sit amet urna in, ornare imperdiet nunc. Aenean porta eget nisl a consectetur. Nam id enim maximus ex vulputate imperdiet ac at ante. Donec vel risus felis.

Vestibulum vel nisl vitae ligula lacinia pretium a sed turpis. Duis et maximus dolor, eget aliquam erat. Vivamus maximus at lacus quis lacinia. Quisque tempus lectus vel aliquet auctor. Fusce lacus elit, fermentum nec nunc eget, rutrum suscipit ligula. In non nunc augue. Duis a sem sed erat tempor vehicula in sit amet risus. Sed sagittis dui ut maximus maximus. In molestie, lacus eget porta molestie, erat lorem molestie mauris, ac eleifend massa lectus ac metus. Aliquam fermentum facilisis nisi accumsan venenatis. Nam rhoncus eget tortor eu tempus. Duis volutpat dolor quis libero euismod, ac dignissim dui scelerisque. Nullam tincidunt vel leo quis varius. Nullam aliquam sapien vel fringilla sodales.</p>

</body>
</html>
