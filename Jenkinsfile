pipeline {
    agent any

    parameters {
        gitParameter(
            name: 'GIT_TAG',
            type: 'PT_TAG',
            description: 'Select git tag to deploy',
            sortMode: 'DESCENDING_SMART'
        )
        choice(
            name: 'TARGET_VM',
            choices: [
                'vm1@192.168.2.45',
                'vm2@192.168.2.47'
            ],
            description: 'Select target VM for deployment'
        )
    }

    environment {
        DOCKER_IMAGE = "mcakmak123/erp-immobilien-php"
        DOCKER_TAG   = "${params.GIT_TAG}"
        VM_HOST      = "${params.TARGET_VM}"
    }

    stages {

        stage('Checkout') {
            steps {
                checkout([
                    $class: 'GitSCM',
                    branches: [[name: "refs/tags/${params.GIT_TAG}"]],
                    userRemoteConfigs: scm.userRemoteConfigs
                ])
                echo "Checked out tag: ${params.GIT_TAG}"
            }
        }

        stage('Build') {
            steps {
                sh '''
                    docker build \
                        --target production \
                        -f docker/php/Dockerfile \
                        -t ${DOCKER_IMAGE}:${DOCKER_TAG} \
                        .
                    echo "Image built: ${DOCKER_IMAGE}:${DOCKER_TAG}"
                '''
            }
        }

        stage('Push') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'dockerhub-credentials',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    sh '''
                        echo "$DOCKER_PASS" | docker login -u "$DOCKER_USER" --password-stdin
                        docker push ${DOCKER_IMAGE}:${DOCKER_TAG}
                        echo "Pushed: ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    '''
                }
            }
        }

        stage('Deploy') {
            steps {
                script {
                    def vmUser = params.TARGET_VM.split('@')[0]
                    def credentialId = "${vmUser}-ssh-key"

                    sshagent(credentials: [credentialId]) {
                        sh """
                            ssh -o StrictHostKeyChecking=no ${params.TARGET_VM} '
                                cd /home/${vmUser}/erp-immobilien-system &&
                                export TAG=${params.GIT_TAG} &&
                                docker compose -f docker-compose.prod.yml pull php &&
                                docker compose -f docker-compose.prod.yml up -d --build &&
                                docker compose -f docker-compose.prod.yml exec -T php php artisan migrate --force &&
                                docker compose -f docker-compose.prod.yml exec -T php php artisan db:seed --force &&
                                docker compose -f docker-compose.prod.yml exec -T php php artisan app:set-version ${params.GIT_TAG} &&
                                echo "Deployed: ${params.GIT_TAG}"
                            '
                        """
                    }
                }
            }
        }
    }

    post {
        success {
            echo "Tag ${params.GIT_TAG} successfully deployed to ${params.TARGET_VM}!"
        }
        failure {
            echo "Pipeline failed for tag ${params.GIT_TAG} on ${params.TARGET_VM}"
        }
        aborted {
            echo "Deploy aborted for tag ${params.GIT_TAG}"
        }
    }
}
