<?php


namespace FPP\Services;

use MrRio\ShellWrap as Shell;

class Git {

    public function getGitBranch()
    {

        $tag = Shell::git("branch --list | grep '\\*' | awk '{print \$2}'");

        if(!$tag)
            return 'Unknown';

        return $tag;
    }

    public function getGitTag()
    {

        $tag = Shell::git('describe --tags');

        if(!$tag)
            return 'Unknown';

        return $tag;
    }

}