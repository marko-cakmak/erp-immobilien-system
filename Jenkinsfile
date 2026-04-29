pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "mcakmak123/erp-immobilien-php"
        DOCKER_TAG = "${BUILD_NUMBER}"
        VM_HOST = "vm1@192.168.2.45"
        APP_DIR = "/home/vm1/erp-immobilien-system"
    }

    stages {

        stage('Checkout') {
            steps {
                checkout scm
                echo "Code pulled from GitHub"
            }
        }

        stage('Build') {
            steps {
                sh '''
                    docker build \
                        --target production \
                        -f docker/php/Dockerfile \
                        -t ${DOCKER_IMAGE}:${DOCKER_TAG} \
                        -t ${DOCKER_IMAGE}:latest \
                        .
                    echo "Image built"
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
                        docker push ${DOCKER_IMAGE}:latest
                        echo "Image pushed to DockerHub"
                    '''
                }
            }
        }

        stage('Deploy') {
            steps {
                sshagent(credentials: ['vm1-ssh-key']) {
                    sh '''
                        ssh -o StrictHostKeyChecking=no ${VM_HOST} "
                            cd ${APP_DIR} &&
                            docker compose -f docker-compose.prod.yml pull &&
                            docker compose -f docker-compose.prod.yml up -d
                            echo 'Deployment finished'
                        "
                    '''
                }
            }
        }
    }

    post {
        success {
            echo "Build #${BUILD_NUMBER} successfully deployed!"
        }
        failure {
            echo "Pipeline failed on Build #${BUILD_NUMBER}"
        }
    }
}
