<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Filesystem\Filesystem;

class DatabaseBackupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('database:backup')
            ->setDescription('dump database and upload to S3')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = 'var/dump/skills';
        $date = new \DateTime();
        $filename = 'skills_backup_' . $date->format('Y-m-d') . '-' . $date->getTimestamp() . '.tar.gz';

        $this->dumpDatabase($path);

        $this->gzipFile($path, $filename);

        $this->uploadToS3($path, $filename);

        $output->writeln('Complete!');
    }

    private function dumpDatabase($path)
    {
        $command = 'mongodump -h db --db skills --out ' . $path;
        shell_exec($command);
    }

    private function gzipFile($path, $filename)
    {
        shell_exec(sprintf('tar -czf %s %s/*', $path . '/' . $filename, $path));
    }

    private function uploadToS3($path, $filename)
    {
        $s3Filesystem = $this
            ->getContainer()
            ->get('oneup_flysystem.s3_filesystem');

        $s3Filesystem->put(
            $filename,
            file_get_contents($path . '/' . $filename)
        );
    }
}
